<?php

$mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$message = file_get_contents('php://input');
$order_details = json_decode($message);

$count=count($requestArray=explode ('/', $_SERVER['REQUEST_URI']));

if (($_SERVER['REQUEST_METHOD'] === 'POST') and $count<4){
    $_id=uniqid();
    $statusString="placed";
    $OneOrderArray=['_id'=>$_id,'location' => $order_details->{'location'}, 'qty' => $order_details->items[0]->{'qty'}, 'name' => $order_details->items[0]->{'name'}, 'milk' => $order_details->items[0]->{'milk'},  'size' => $order_details->items[0]->{'size'},'status'=>$statusString,'message'=>"Order has been placed."];
//echo var_dump($OneOrderArray);
$bulk = new MongoDB\Driver\BulkWrite;
$bulk->insert($OneOrderArray);
$mng->executeBulkWrite('starbucks.orders', $bulk);
$myObj = new stdClass();
		$myObj->id = $_id;
		$myObj->location = $order_details->{'location'};
		$myObj->items = [['qty'=>$order_details->items[0]->{'qty'}, 'name'=>$order_details->items[0]->{'name'}, 'milk'=>$order_details->items[0]->{'milk'}, 'size'=>$order_details->items[0]->{'size'}]];
		$myObj->links=['payment'=>"http://localhost/phpmongodb/order/".$_id."/pay",'Order'=>"http://localhost/phpmongodb/order/".$_id];
		$myObj->status="placed";
		$myObj->message="Order has been placed.";
		//var_dump($OneOrderArray);
		$myJSON = json_encode($myObj);
		

			echo $myJSON;

}
else if ($_SERVER['REQUEST_METHOD'] === 'GET' and $requestArray[2] !="orders"){
                    //    echo "i am in get";
			//echo "GET Request the current state of the order specified by the URI.";
			//echo $_SERVER['REQUEST_URI'];
			$requestArray=explode ('/', $_SERVER['REQUEST_URI'] );
		  //      echo var_dump($_SERVER['REQUEST_URI']);
		//	echo "the request id is".  $requestArray[2];
			//$IDQuery = array('_id' => $requestArray[2]);

			$filter=['_id'=>$requestArray[2]];

                       // $options = [ 'projection' => ['_id' => 0],];
		//	var_dump($filter);
			$query = new MongoDB\Driver\Query($filter);
			$cursor = $mng->executeQuery('starbucks.orders', $query);
			foreach ($cursor as $doc) {
    			  //	var_dump($doc);
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

}
else if ($_SERVER['REQUEST_METHOD'] === 'PUT'){
			
			$requestArray=explode ('/', $_SERVER['REQUEST_URI'] );
			//$IDQueryPut = array('_id' => $requestArray[3]);
			$bulk = new MongoDB\Driver\BulkWrite;
			$bulk->update([ '_id' => $requestArray[2]],
                        ['$set' => ['location' => $order_details->{'location'}, 'qty' => $order_details->items[0]->{'qty'}, 'name' => $order_details->items[0]->{'name'}, 'milk' => $order_details->items[0]->{'milk'},  'size' => $order_details->items[0]->{'size'}]]);
			$mng->executeBulkWrite('starbucks.orders', $bulk);
		//	$updateResult = $empcollection->updateOne(
		//	[ '_id' => $requestArray[2]],
		//	['$set' => ['location' => $order_details->{'location'}, 'qty' => $order_details->items[0]->{'qty'}, 'name' => $order_details->items[0]->{'name'}, 'milk' => $order_details->items[0]->{'milk'},  'size' => $order_details->items[0]->{'size'}]]);
		//	$IDQuery = array('_id' => $requestArray[3]);
		//	$doc=$empcollection->findOne($IDQuery);
			//foreach ($cursor as $doc) {
			//var_dump($doc);
			//}
		  //  if (count($doc)>0){
		/*		$myObjGet = new stdClass();
		
				$myObjGet->id =$doc['_id'] ;
		
				$myObjGet->items = [['milk'=>$doc['milk'],'name'=>$doc['name'],'qty'=>$doc['qty'] , 'size'=>$doc['size']]];
				$myObjGet->links=['payment'=>"http://localhost/phpmongodb/order/".$doc['_id']."/pay",'Order'=>"http://localhost/phpmongodb/order/".$doc['_id']];
				$myObjGet->location=$doc['location'];
				$myObjGet->status=$doc['status'];
				$myObjGet->message=$doc['message'];;
				//var_dump($OneOrderArray);
				$myJSON = json_encode($myObjGet);
		

				echo $myJSON;*/
		
			//}
		
	              $filter=['_id'=>$requestArray[2]];

                       // $options = [ 'projection' => ['_id' => 0],];
                //      var_dump($filter);
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor = $mng->executeQuery('starbucks.orders', $query);
                        foreach ($cursor as $doc) {
                          //    var_dump($doc);
                        }

                //      echo "the id from the retruend find is" . $doc->_id   ;
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

		}
		else if ($_SERVER['REQUEST_METHOD'] === 'DELETE'){
		//	echo "DELETE Logically remove the order identified by the given URI.";
			$requestArray=explode ('/', $_SERVER['REQUEST_URI'] );
		//	$empcollection->deleteOne(['_id' => $requestArray[3]]);
		        $bulk = new MongoDB\Driver\BulkWrite;
		        $bulk->delete(['_id' => $requestArray[2]]);
		        $mng->executeBulkWrite('starbucks.orders', $bulk);
	//	echo "inside delete";
		}//end delete
                else if ($_SERVER['REQUEST_METHOD'] === 'POST'){
			//this is for paying 
			$requestArray=explode ('/', $_SERVER['REQUEST_URI'] );
			$bulk = new MongoDB\Driver\BulkWrite;
                        $bulk->update([ '_id' => $requestArray[2]],['$set' => ['status'=>"paid"]]);
                        $mng->executeBulkWrite('starbucks.orders', $bulk);

		//	$updateResult = $empcollection->updateOne(
		//	[ '_id' => $requestArray[3]],
		//	['$set' => ['status'=>"paid"]]);
			//$IDQuery = array('_id' => $requestArray[3]);
			//$doc=$empcollection->findOne($IDQuery);
			//foreach ($cursor as $doc) {
			//var_dump($doc);
			//}
		    /*if (count($doc)>0){
				$myObjGet = new stdClass();
		
				$myObjGet->id =$doc['_id'] ;
		
				$myObjGet->items = [['milk'=>$doc['milk'],'name'=>$doc['name'],'qty'=>$doc['qty'] , 'size'=>$doc['size']]];
				$myObjGet->links=['payment'=>"http://localhost/phpmongodb/order/".$doc['_id']."/pay",'Order'=>"http://localhost/phpmongodb/order/".$doc['_id']];
				$myObjGet->location=$doc['location'];
				$myObjGet->status=$doc['status'];
				$myObjGet->message=$doc['message'];;
				//var_dump($OneOrderArray);
				$myJSON = json_encode($myObjGet);
		

				echo $myJSON;
		
			}*/
			$filter=['_id'=>$requestArray[2]];

                       // $options = [ 'projection' => ['_id' => 0],];
		//	var_dump($filter);
			$query = new MongoDB\Driver\Query($filter);
			$cursor = $mng->executeQuery('starbucks.orders', $query);
			foreach ($cursor as $doc) {
    			  //	var_dump($doc);
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
		}else if ($_SERVER['REQUEST_METHOD'] === 'GET'){
				echo "i am in orders";
		          //    echo "i am in get";
			$requestArray=explode ('/', $_SERVER['REQUEST_URI'] );
		  //      echo var_dump($_SERVER['REQUEST_URI']);
		//	echo "the request id is".  $requestArray[2];
			//$IDQuery = array('_id' => $requestArray[2]);

			$filter=['_id'=>$requestArray[2]];

                       // $options = [ 'projection' => ['_id' => 0],];
		//	var_dump($filter);
			$query = new MongoDB\Driver\Query([]);
			$cursor = $mng->executeQuery('starbucks.orders',$query );
			foreach ($cursor as $doc) {
    			  //	var_dump($doc);
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
				
		

				
		
			

}

?>
