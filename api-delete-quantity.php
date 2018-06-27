

<?php
	// The id that the client passes
	$EventId = $_GET['id'];
	// echo $EventId;
// echo $EventId;
	$sData = file_get_contents( 'Event.txt' );
	// convert the text to an object (array)
	$aData = json_decode( $sData );
	// Get rid of the price from the array
	for($i = 0; $i < count($aData); $i++){
				if( $aData[$i]->id==$EventId ){
					 $aData[$i]->Quantity+=1;
					$sData=json_encode($aData);
					file_put_contents('Event.txt', $sData);
					echo json_encode($aData[$i]);
				    exit;
				  }
		     }



?>