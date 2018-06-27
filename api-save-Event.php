<?php

// Get the file and save it with a unique id
$sFileExtension = pathinfo($_FILES['EventImgfile']['name'], PATHINFO_EXTENSION);
// Save the file to the pictures folder
$sFolder = 'EventImage/';
$sFileName = 'EventImg-'.uniqid().'.'.$sFileExtension;//add Unique id in image
$sSaveFileTo = $sFolder.$sFileName; // pictures/new-schedule.png
// Finally save by using a php function
move_uploaded_file( $_FILES['EventImgfile']['tmp_name'], $sSaveFileTo);


// recieve the data and make them into JSON Object.
$jNewEvent = json_decode('{}');
$jNewEvent->id = uniqid();
$jNewEvent->Name = $_POST['txtEventName'];
$jNewEvent->Partners = $_POST['txtEventPartners'];
$jNewEvent->Location = $_POST['txtEventLocation'];
$jNewEvent->Topic = $_POST['txtEventTopic'];
$jNewEvent->Date = $_POST['txtEventDate'];
$jNewEvent->Time = $_POST['txtEventTime'];
$jNewEvent->Quantity = $_POST['txtquantity'];
$jNewEvent->Image = $sSaveFileTo;


// open the file
$sData = file_get_contents('Event.txt');
// convert the text to an object / array
$aData = json_decode( $sData );

// push the data to the array
array_push( $aData, $jNewEvent );
// Encode all the users and save it to the file;
$sData = json_encode($aData);
file_put_contents('Event.txt', $sData);
echo $sData;

 //echo $sUserName.' '.$sUserLastName.' '.$year;
// echo  "Name:".''.$sUserName.'  '."LastName:".'  '.$sUserLastName.'  '."Year:".' '.$year;
?>
