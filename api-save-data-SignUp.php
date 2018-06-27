<?php

// Get the file and save it with a unique id
$sFileExtension = pathinfo($_FILES['UserImgfile']['name'], PATHINFO_EXTENSION);
// Save the file to the pictures folder
$sFolder = 'img/';
$sFileName = 'userImg-'.uniqid().'.'.$sFileExtension;//add Unique id in image
$sSaveFileTo = $sFolder.$sFileName; // pictures/new-schedule.png
// Finally save by using a php function
move_uploaded_file( $_FILES['UserImgfile']['tmp_name'], $sSaveFileTo);



// recieve the data and make them into JSON Object.
$jNewUser = json_decode('{}');
$jNewUser->id = uniqid();
$jNewUser->Name = $_POST['txtUserName'];
$jNewUser->LastName = $_POST['txtUserLastName'];
$jNewUser->Password = $_POST['txtUserPassword'];
$jNewUser->Email = $_POST['txtUserEmail'];
$jNewUser->Mobile = $_POST['txtUserMobile'];
$jNewUser->image = $sSaveFileTo;

// open the file for customer
$sData = file_get_contents('User.txt');
// convert the text to an object / array
$aData = json_decode( $sData );

// open the file for Admin
$Sadmin=file_get_contents('Admin.txt');
$admin=json_decode($Sadmin);

// open the file for stakeholder
$sStakeholder=file_get_contents('Stakeholder.txt');
$aStakeholder=json_decode($sStakeholder);

$SignUpEmail = $_POST['txtUserEmail'];
echo  $SignUpEmail;

if(strstr($SignUpEmail, "Myadmin")!==false)
		{
	array_push( $admin, $jNewUser );
	$Sadmin=json_encode($admin);
	file_put_contents('Admin.txt', $Sadmin);
	echo $Sadmin;
		}

		elseif(strstr($SignUpEmail, "Super")!==false){
	array_push( $aStakeholder, $jNewUser );
	$sStakeholder=json_encode($aStakeholder);
	file_put_contents('Stakeholder.txt', $sStakeholder);
	echo $sStakeholder;
		}
		else{
		// push the data to the array
		array_push( $aData, $jNewUser );
		// Encode all the users and save it to the file;
		$sData = json_encode($aData);
		file_put_contents('User.txt', $sData);
		echo $sData;
		}

 //echo $sUserName.' '.$sUserLastName.' '.$year;
// echo  "Name:".''.$sUserName.'  '."LastName:".'  '.$sUserLastName.'  '."Year:".' '.$year;
?>
