<?php
session_start();
	// Data comes from the browser/user input
	$sUserEmail = $_POST['UserEmail'];
	$sUserPassword = $_POST['txtUserPassword'];
	// $M= "imran_bth@yahoo.com";
  
//read Data from file
	$sajLetters = file_get_contents('User.txt');
    $ajLetters = json_decode($sajLetters);
    
    for($i=0; $i<count($ajLetters); $i++){
       $jItem = $ajLetters[$i]; 
      $findEmail= $jItem->Email;
      $findPassword= $jItem->Password;

      //comapre data from input with txt file to login
      if (($sUserEmail==$findEmail)&&($sUserPassword==$findPassword)) {
        
      			 // {echo " Name and Email found in the file";}  
     			 $_SESSION['sCorrectUserEmail'] = $sUserEmail;
     			 // send this to the client
  				$sjResponse = '{"login":"ok","MatchUserEmail":"'.$sUserEmail.'"}';
				echo $sjResponse;
				exit;
			  }
    }
			  $sjResponse = '{"login":"error"}';
			  echo $sjResponse;
			  exit;
    
 
?>