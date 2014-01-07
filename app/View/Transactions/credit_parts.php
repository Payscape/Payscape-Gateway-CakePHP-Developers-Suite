<?php 


if(isset($transactionid)){
	$transactionid = (int) $transactionid;
}

if($transactionid==0){

	$this->Session->setFlash(__('Invalid Transaction.'));

	$this->redirect(array('controller'=>'transactions', 'action'=>'index'));
}

// 668 
if($result_array['response']==1){
	$this->request	->data['Transaction']['id'] = $transactionid;
	$this->request->data['Transaction']['type'] = 'credit';
	$this->request->data['Transaction']['transactionid'] = $result_array['transactionid'];
	$this->request->data['Transaction']['authcode'] = $result_array['authcode'];

	$this->set('result_array', $result_array);

	if ($this->Transaction->save($this->request->data)) {
		$process = 2;
		$this->Session->setFlash(__('Credit Transaction successful, and the data has been saved.'));
	} else {
		$this->Session->setFlash(__('Credit Transaction unsuccessful, no data has been saved'));
	}


	//debug($response);
	//	exit();
	/*
	 echo "INCOMING: <br>";
	echo "<pre>";
	debug($incoming);
	echo "<br>RESPONSE:<br>";
	debug($response);

	echo "</pre>";

	exit();
	*/



} else {
	$this->Session->setFlash(__('Credit Transaction unsuccessful, no data has been saved. Please, try again.'));
} // result array
?>