<?php

/**
 *
 * @author Loning
 *        
 */
abstract class EMongoObjectDocument extends EMongoDocument {
	
	
	/**
	 * Mongo model classname
	 * @var string
	 */
	public $_type;

	
	protected function getClass(){
		if($this->_type == null){
			return get_class($this);
		}else{
			return $this->_type;
		}
	}
	
	/**
	 * @return EMongoObjectDocument
	 */
	public function create(){
		return new $this->class;
	}
	
	protected function instantiate($attributes)
	{
		if(isset($attributes['_type'])){
			$class=$attributes['_type'];
		}else{
			$class=get_class($this);
		}
		$model=new $class(null);
		$model->_type=$class;
		$model->initEmbeddedDocuments();
		$model->setAttributes($attributes, false);
		return $model;
	}
	
	public function init()
	{
		parent::init();
		if($this->_type == null)
			$this->_type=get_class($this);
	}
	
	/**
	 * @return int
	 */
	public function getInsertDate(){
		return $this->_id->getTimestamp();
	}
	
}

?>