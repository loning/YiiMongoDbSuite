<?php
/**
 *
 * @author Loning
 *        
 *        
 */

abstract class EMongoUserFile extends EMongoFile {

	/**
	 * 
	 * @var MongoId
	 */
	public $uid;
	
	public function indexes(){
		return array_merge(parent::indexes(),array(
	 		'uid'=>array('key'=>array('uid'=>EMongoCriteria::SORT_ASC)),
	 	));
	}
}

?>