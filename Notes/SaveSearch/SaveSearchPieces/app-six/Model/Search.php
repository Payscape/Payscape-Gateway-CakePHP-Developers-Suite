<?php
/**
 * PHP 5
 * Search Results Handling Model
 *
 * Model used by Search Results etc.
 *
 * @package       Cake.Model
 */
class Search extends AppModel {

	public $displayField = 'name';

	public $validate = array(
		'name' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'message' => 'this field canot be left blank'
		),
	);

	public $belongsTo = array(
		'User',
	);

	public function beforeSave($options = array( )) {
		// TODO: remove all the location specific values from the search
		return parent::beforeSave($options);
	}

}

