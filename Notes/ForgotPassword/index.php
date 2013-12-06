<?php 
		$step = 'form';
		if ( ! empty($this->request->params['token'])) {
			$forgot = $this->Forgot->findByToken($this->request->params['token']);

			if ( ! $forgot) {
				$this->Session->setFlash(__('Sorry, no Password information has been found.', true), 'default', 'n');				
				$this->redirect('/');
			}

			// make sure our request is not past it's expiration date
			if (strtotime($forgot['Forgot']['created']) <= strtotime('-1 days')) {
				$step = 'expired';
				$this->Session->setFlash(__('Sorry, your token has expired.', true), 'default', 'n');
				$this->redirect(array('controller' => 'forgots', 'action' => 'index'));
			}
			else {
				$user = $this->Forgot->User->findById($forgot['Forgot']['user_id']);

				if ( ! $user) {
					$this->Session->setFlash(__('Invalid email address. Please enter your registered email address.', true), 'default', 'f');
					$this->redirect(array('controller' => 'forgots', 'action' => 'index'));
				}

				// reset the user's pass
				$password = $this->Forgot->User->reset_pass($user['User']['id']);

				// send the email
				$mail = new CakeEmail( );
				$mail->from($this->email_from);
				$mail->to($user['User']['email']);
				$mail->subject('New Reset Password');
				$mail->emailFormat('text');
				$mail->template('reset');
				$mail->viewVars(array(
					'site_name' => $this->site_name,
					'password' => $password,
				));

			/*/ debugging
			 * 
			 */
				Configure::write('debug', 2);
				$mail->transport('Debug');
				debug($mail->send( ));
				die;
			/**/

				try {
					$mail->send( );
					$this->Forgot->delete($forgot['Forgot']['id']);

					// let the user know
					$step = 'reset';
					$this->Session->setFlash(__('A new password has been sent to your email address.', true), 'default', 's');
					$this->redirect(array('controller' => 'users', 'action' => 'login'));
				}
				catch (Exception $e) {
$this->do_log($e);
					$step = 'fail';
					$this->Session->setFlash(__('There was an error sending the email, please try again.', true), 'default', 'f');
					$this->redirect(array('controller' => 'forgots', 'action' => 'index'));
				}
			}
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$user = $this->Forgot->User->findByEmail($this->request->data['User']['email']);
			if ($user) {
				// create a new forgots entry
				$token = $this->Forgot->make($user['User']['id']);

				if ($token) {
					// send the email
					$mail = new CakeEmail( );
					$mail->from($this->email_from);
					$mail->to($user['User']['email']);
					$mail->subject('Password Reset Requested');
					$mail->emailFormat('text');
					$mail->template('sent');
					$mail->viewVars(array(
						'site_name' => $this->site_name,
						'link' => Router::url(array('controller' => 'forgots', 'action' => 'change', 'token' => $token), true),
					));

				/*/ debugging
					Configure::write('debug', 2);
					$mail->transport('Debug');
					debug($mail->send( ));
					die;
				//*/

					try {
						$mail->send( );

						// let the user know
						$step = 'sent';
						$this->Session->setFlash(__('A password change request has been sent to your email address.', true), 'default', 's');
						$this->redirect(array('controller' => 'users', 'action' => 'login'));
					}
					catch (Exception $e) {
						$this->do_log($e);
						$step = 'fail';
						$this->Session->setFlash(__('There was an error sending the email, please try again.', true), 'default', 'f');
						$this->redirect(array('controller' => 'forgots', 'action' => 'index'));
					}
				}
				else {
					$step = 'fail';
					$this->Session->setFlash(__('There was an error sending the email, please try again.', true), 'default', 'f');
					$this->redirect(array('controller' => 'forgots', 'action' => 'index'));
				}
			}
			else {
				$this->Session->setFlash(__('Invalid email address. Please enter your registered email address.', true), 'default', 'f');
				$this->redirect(array('controller' => 'forgots', 'action' => 'index'));
			}
		}

		$this->set('step', $step);
		
?>		