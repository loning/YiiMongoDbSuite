<?php
/** 
 * 
 * Present structs of graph
 * @author Loning
 * 
 * 
 */
class EMongoGraphDocument extends EMongoEmbeddedDocument {
	public $edges	=	array();
	
	
	
	public function addEdge($id,$type=null,$other=array()){
		$other['id']=$id;
		if($type!=null)
			$other['type']=$type;
		$this->edges[]=$other;
	}
	
}

?>