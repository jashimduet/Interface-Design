<?php 
// Load all the Events and decode them to an array
$sEvents = file_get_contents('Event.txt');
$aEvents = json_decode($sEvents);

for ($i = 0; $i < count($aEvents); $i++) {
  
}

$sEvents = json_encode($aEvents);
echo $sEvents;

?>
