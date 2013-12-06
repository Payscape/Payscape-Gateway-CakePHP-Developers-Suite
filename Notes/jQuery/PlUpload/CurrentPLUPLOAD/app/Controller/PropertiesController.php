<?php
switch ($step) {
	case 'photos' :
		/*
		 * Here url parameter "file" is used for
		 * uploading image files using drag and drop feature
		 *
		 */
		if ( ! empty($this->request->query['file'])) {
			Configure::write('debug', 1);
			$tmp_filename = $this->request->params['form']['file']['tmp_name'];

			//lets handle the image if we know it's a big one
			if ($this->request->params['form']['file']['name'] == 'blob'){
				//this session is a flag that lets us know if we are in middle of a streamed image or the beginning.
				$image = $this->Session->read('stream');
				$path = TMP.'tmp_img.jpg';

				if (empty($image)) {
					//setup the flag if this is the first stream.
					$this->Session->write('stream', '1');
					$iHandle = fopen($path, 'w');
				}
				else {
					$iHandle = fopen($path, 'a');
				}

				$tHandle = fopen($this->request->params['form']['file']['tmp_name'], 'rb');
				//lets add the current chunk to the uploaded temp file.
				fwrite($iHandle, stream_get_contents($tHandle));
				fclose($tHandle);
				fclose($iHandle);

				//are we at the end of the stream?
				//if so lets fix the params so we won't have to touch the behavior.
				if ($this->request->params['form']['file']['size'] != 1048576){
					$this->request->params['form']['file']['name'] = time().'.jpg';
					$this->request->params['form']['file']['tmp_name'] = $path;
					$this->request->params['form']['file']['type'] = 'image/jpeg';
					$this->request->params['form']['file']['size'] = filesize($path);
					$tmp_filename = $this->request->params['form']['file']['tmp_name'];
					//this is the last part of the stream so lets remove the session
					$this->Session->delete('stream');
				}
				else {
					exit;
				}
			}
			$this->request->data['PropertyImage']['image'] = $this->request->params['form']['file'];
			$this->Property->PropertyImage->set($this->request->data);

			if ( ! $this->Property->PropertyImage->validates()) {
				$errors = $this->Property->PropertyImage->validationErrors;
				echo json_encode(array('errors' => $errors));
				exit;
			}

			if (file_exists($tmp_filename)) {
				$filename = time() . "_" . rand(0, 100);

				if (is_uploaded_file($tmp_filename)) {
					move_uploaded_file($tmp_filename, TMP . $filename);
				}
				else {
					copy($tmp_filename, TMP . $filename);
				}

				$this->request->params['form']['file']['tmp_name'] = TMP . $filename;
				echo json_encode($this->request->params['form']['file']);
				exit;
			}
		}

		if ( ! empty($this->request->data)) {
			/*
			 * Checking maximum limit for file uploads
			*/
			if ( ! isset($this->request->data['image_count'])) {
				//$this->request->data['image_count'] = 0;
				$this->request->data['image_count'] = (int) $this->Property->PropertyImage->find('count', array(
						'conditions' => array(
								'PropertyImage.property_id' => $this->request->data['Property']['id'],
						),
				));
			}

			if ($this->request->data['image_count'] >= 8 ) {
				$this->Session->setFlash(__('Maximum 8 files are allowed if you want to add more images please delete existing photos ', true), 'default', 'n');
				$this->redirect(array('action' => 'create', 'photos', $this->request->data['Property']['id']));
			}

			$count_imgs = count($this->request->data['PropertyImage']) - $this->request->data['image_count'];
			if ( ! empty($this->request->data['PropertyImage']['upload']['image']['error'])) {
				$count_imgs--;
			}

			/*
			 * if no image is uploaded no need to proceed further
			* so redirect to the page with a notice
			*/
			if ( ! $count_imgs) {
				$this->Session->setFlash(__('Please upload a photo', true), 'default', 'f');
				$this->redirect(array('action' => 'create', 'photos', $this->request->data['Property']['id']));
			}

			if (isset($this->request->data['save_images'])) {
				$tempVar = $this->request->data['save_images'];
			}
			/*
			 * if any invalid mimetypes are uploaded than show an error
			* and redirect to the same page
			*/

			if (isset($this->request->data['error'])) {
				$this->Session->setFlash($this->request->data['error'], 'default', 'f');
				$this->redirect(array('action' => 'create', 'photos', $this->request->data['Property']['id']));
			}

			$full = $this->Property->PropertyImage->process($this->request->data);
			unset($this->request->data['PropertyImage']);

			if ($full) {
				$this->Session->setFlash(__('Only 8 images allowed.', true), 'default', 's');
				$this->redirect(array('action' => 'create', 'photos', $this->request->data['Property']['id']));
			}


			// test the number of images
			$image_count = (int) $this->Property->PropertyImage->find('count', array(
					'conditions' => array(
							'PropertyImage.property_id' => $this->request->data['Property']['id'],
					),
			));

			if ( ! $image_count) {
				$this->Property->invalidate('images', 'You must upload at least one image');
				$this->redirect(array('action' => 'create', 'photos', $this->request->data['Property']['id']));
			}

			// save these because Cake kills them when we read( )
			$validation_errors = $this->Property->validationErrors;

			$message = (($count_imgs > 1) ? 'Photos have ' : 'Photo has ') . 'been uploaded';
			$this->Session->setFlash(__($message, true), 'default', 's');
			$this->redirect(array('action' => 'create', 'photos', $this->request->data['Property']['id']));
		}

		break;