<?php
App::uses('AppModel', 'Model');
/**
 * Transaction Model
 *
 * @property Credit $Credit
 * @property Refund $Refund
 * @property Void $Void
 */
class Transaction extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Refund' => array(
			'className' => 'Refund',
			'foreignKey' => 'transaction_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
	);

}// end Transaction model