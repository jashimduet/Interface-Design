<?php
	session_start();
// Data comes from the browser
	$sAdminEmail = $_POST['AdminEmail'];
	$sAdminPassword = $_POST['txtAdminPassword'];
	 

//read Data from file
	  $sajadminLetters = file_get_contents('Admin.txt');
      $ajadminLetters = json_decode($sajadminLetters);


 for($i=0; $i<count($ajadminLetters); $i++){
      $jadminItem = $ajadminLetters[$i]; 
      $findadminEmail= $jadminItem->Email;
      $findadminPassword= $jadminItem->Password;
         

	if( ($sAdminEmail == $findadminEmail ) && ($sAdminPassword == $findadminPassword ) )
	{
		$_SESSION['AdminEmail'] = $sAdminEmail;
		// send this to the client
		$sjResponse = '{"login":"ok","Email":"'.$sAdminEmail.'"}';
		echo $sjResponse;
		exit;
	}

  }
	$sjResponse = '{"login":"error"}';
	echo $sjResponse;
	exit;


?>