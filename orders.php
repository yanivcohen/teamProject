<?php
echo "i am in orders";
/*

$mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");

				echo "i am in orders";
		          //    echo "i am in get";
			//$requestArray=explode ('/', $_SERVER['REQUEST_URI'] );
		  //      echo var_dump($_SERVER['REQUEST_URI']);
		//	echo "the request id is".  $requestArray[2];
			//$IDQuery = array('_id' => $requestArray[2]);

		//	$filter=['_id'=>$requestArray[2]];

                       // $options = [ 'projection' => ['_id' => 0],];
		//	var_dump($filter);
			$query = new MongoDB\Driver\Query([]);
			$cursor = $mng->executeQuery('starbucks.orders',$query );
			foreach ($cursor as $doc) {
    			  	var_dump($doc);
			
			}
                //	echo "the id from the retruend find is" . $doc->_id   ;
			//$doc=$empcollection->findOne($IDQuery);
			//foreach ($cursor as $doc) {
			//var_dump($doc);
			//}
		    if (count($doc)>0){
				$myObjGet = new stdClass();
		
				$myObjGet->id =$doc->_id ;
		
				$myObjGet->items = [['milk'=>$doc->milk,'name'=>$doc->name,'qty'=>$doc->qty , 'size'=>$doc->size]];
				$myObjGet->links=['payment'=>"http://localhost/phpmongodb/order/".$doc->_id."/pay",'Order'=>"http://localhost/phpmongodb/order/".$doc->_id];
				$myObjGet->location=$doc->location;
				$myObjGet->status=$doc->status;
				$myObjGet->message=$doc->message;
				//var_dump($OneOrderArray);
				$myJSON = json_encode($myObjGet);
		

				echo $myJSON;
		
			}
				

*/

?>
