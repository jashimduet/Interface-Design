
<?php
session_start();
  // Data comes from the browser/user input
  $sStakeholderEmail = $_POST['StakeholderEmail'];
  $sStakeholderPassword = $_POST['txtStakeholderPassword'];
  // $M= "imran_bth@yahoo.com";
  
//read Data from file
  $sajLetters = file_get_contents('Stakeholder.txt');
    $ajLetters = json_decode($sajLetters);
    
    for($i=0; $i<count($ajLetters); $i++){
       $jItem = $ajLetters[$i]; 
      $findEmail= $jItem->Email;
      $findPassword= $jItem->Password;

      //comapre data from input with txt file to login
      if (($sStakeholderEmail==$findEmail)&&($sStakeholderPassword==$findPassword)) {
        
             // {echo " Name and Email found in the file";}  
           $_SESSION['sCorrectStakeholderEmail'] = $sStakeholderEmail;
           // send this to the client
          $sjResponse = '{"login":"ok","MatchStakeholderEmail":"'.$sStakeholderEmail.'"}';
        echo $sjResponse;
        exit;
        }
    }
        $sjResponse = '{"login":"error"}';
        echo $sjResponse;
        exit;
    
?>