<?php
/**
 * EMongoUniqueValidator.php
 *
 * PHP version 5.2+
 *
 * @author		Dariusz Górecki <darek.krk@gmail.com>
 * @author		Invenzzia Group, open-source division of CleverIT company http://www.invenzzia.org
 * @copyright	2011 CleverIT http://www.cleverit.com.pl
 * @license		http://www.yiiframework.com/license/ BSD license
 * @version		1.3
 * @category	ext
 * @package		ext.YiiMongoDbSuite
 * @since		v1.1
 */

/**
 * @since v1.1
 */
class EMongoUniqueValidator extends CValidator
{
	public $allowEmpty=true;

	public $model;
	
	public function init(){
		
	}
	
	public function validateAttribute($object, $attribute)
	{
		if($this->message===null)
			$this->message = Yii::t('yii', '{attribute} is not unique in DB.');
		if($this->model)
			$m=EMongoDocument::model($this->model);
		else
			$m=$object;
		$value = $object->{$attribute};
		if($this->allowEmpty && ($value === null || $value === ''))
			return;

		$criteria = new EMongoCriteria;
		$criteria->{$attribute} = $value;
		$count = $m->count($criteria);

		if($count !== 0)
			$this->addError(
				$object,
				$attribute,
				$this->message
			);
	}
}