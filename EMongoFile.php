<?php
/**
 *
 * @author Loning
 * @property-read string $url
 *        
 */

abstract class EMongoFile extends EMongoGridFS {

	/**
	 * 
	 * @var array
	 */
	public $metadata;
	
	
	/**
	 * Returns the static model of the specified AR class.
	 *
	 * @param string $className class name
	 *
	 * @return MongoImage CompaniesDb the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function rules()
	{
		return array(
				array('filename, metadata','safe'),
				array('filename','required'),
		);
	}
	
	public function write($filename=null){
		if($filename === null)
			return parent::write(Yii::getPathOfAlias('webroot').DIRECTORY_SEPARATOR.$this->filename);
		return parent::write($filename);
	}
	
	public function realFilename(){
		return Yii::getPathOfAlias('webroot').DIRECTORY_SEPARATOR.$this->filename;
	}
	
	public function writeTemp(){
		$filename = tempnam(sys_get_temp_dir(), 'emf');
		parent::write($filename);
		return $filename;
	}
	
	public function allowExtensions(){
		return array("jpeg", "xml", "bmp","jpg","png","gif");
	}
	
	public function sizeLimit(){
		return 1 * 1024 * 1024;
	}
	
	public function getUrl(){
		return CHtml::normalizeUrl(array('/mfile/default/get','type'=>get_class($this),'id'=>$this->_id));
	}
}

?>