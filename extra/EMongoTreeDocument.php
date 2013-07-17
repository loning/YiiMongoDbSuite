<?php

/**
 *
 * @author Loning
 *        
 *        
 */

abstract class EMongoTreeDocument  extends EMongoDocument {
	/**
	 * present the path
	 * @var string
	 */
	public $path;
	public $nodeName;
	
	
	/**
	 * Node name,used in path,such as path = a,b,c,d,e,f,
	 * @return string name (not changed) in path
	 */
	public function getNodeName(){
		return $this->nodeName;
	}
	
	/**
	 * Set the node's parent
	 * @param string $parentPath
	 */
	public function setParent($parentPath){
		$this->path=$parentPath.','.$this->getNodeName();
	}
	
}

?>