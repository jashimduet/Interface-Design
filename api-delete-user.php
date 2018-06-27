
<?php
	// The id that the client passes
	$userId = $_GET['id'];
// echo $userId;
	$sData = file_get_contents( 'User.txt' );
	// convert the text to an object (array)
	$aData = json_decode( $sData );
	// Get rid of the price from the array
	for($i = 0; $i < count($aData); $i++){
		if( $aData[$i]->id == $userId){
		// unset($aData[$i]);
		array_splice($aData, $i, 1);
		$sData=json_encode($aData);
		file_put_contents('User.txt', $sData);
		echo $sData;
		exit;
		}
	}



?>