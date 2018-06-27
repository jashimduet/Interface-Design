
<?php 
$sUserId = $_GET['id'];

// Load all the users and decode them to an array
$sUsers = file_get_contents('User.txt');
$aUsers = json_decode($sUsers);

for ($i = 0; $i < count($aUsers); $i++) {
    if ($aUsers[$i]->id == $sUserId) {
        echo json_encode($aUsers[$i]);
        return;
  }
}
?>