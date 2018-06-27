<?php 
// Load all the users and decode them to an array
$sUsers = file_get_contents('User.txt');
$aUsers = json_decode($sUsers);

for ($i = 0; $i < count($aUsers); $i++) {
  unset( $aUsers[$i]->LastName );
  unset( $aUsers[$i]->Password );
  unset( $aUsers[$i]->Email );
  unset( $aUsers[$i]->Mobile );
  unset( $aUsers[$i]->image );

}

$sUsers = json_encode($aUsers);
echo $sUsers;

?>