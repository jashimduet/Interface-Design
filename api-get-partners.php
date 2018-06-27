<?php 
// Load all the Events and decode them to an array
$sPartners = file_get_contents('Event.txt');
$aPartners = json_decode($sPartners);

for ($i = 0; $i < count($aPartners); $i++) {
  unset( $aUsers[$i]->id );
  unset( $aUsers[$i]->Location );
  unset( $aUsers[$i]->Topic );
  unset( $aUsers[$i]->Quantity );
  unset( $aUsers[$i]->Image );
}

$sPartners = json_encode($aPartners);
echo $sPartners;

?>