
<?php 
$sEventId = $_GET['id'];

// Load all the users and decode them to an array
$sEvents = file_get_contents('Event.txt');
$aEvents = json_decode($sEvents);

for ($i = 0; $i < count($aEvents); $i++) {
    if ($aEvents[$i]->id == $sEventId) {
        echo json_encode($aEvents[$i]);
        return;
  }
}
?>