<?php

/**
 *
 * @author Loning
 *        
 */
class EMongoDate {
	/**
	 * 
	 * @param MongoDate $date
	 * @param int $seconds
	 */
	public static function addSeconds($seconds,$date=null){
		if($date===null)
			$date=self::now();
		$date->sec+=$seconds;
		return $date;
	}
	/**
	 * 
	 * @param MongoDate $date
	 * @param float $seconds
	 */
	public static function addFloatSeconds($seconds,$date=null){
		if($date===null)
			$date=self::now();
		$int=(int)$seconds;
		
		//echo " $seconds $int $date->sec $date->usec ";
		$date->sec+=$int;
		$date->usec+=($seconds-$int)*1000000;
		if($date->usec<0)
		{
			$date->sec--;
			$date->usec+=1000000;
		}else{
			if($date->usec>1000000){
				$date->sec++;
				$date->usec-=1000000;
			}
		}
		return $date;
	}
	
	/**
	 * 
	 * @param MongoDate $date
	 * @return string
	 */
	public static function display($date){
		return date(sprintf('Y-m-d\TH:i:s\.%06dP', (int)($date->usec)),$date->sec);
	}
	
	/**
	 * @return MongoDate
	 */
	public static function now(){
		$ms=microtime(true);
		$sec=intval($ms);
		$usec=($ms-$sec)*1000000;
		$date=new MongoDate($sec,$usec);
		//$date=new MongoDate(time());
		return $date;
	}
	
	public static function parse($str){
		return new MongoDate(strtotime($str));
	}
}

?>