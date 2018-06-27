<?php

      // Do I need to update something or just display the data
      $sEvents = file_get_contents('Event.txt');
      $aEvents = json_decode($sEvents);

      $Oldvalue=$_POST['oldInfo'];
      $Newvalue=$_POST['newInfo'];

  
        for($i=0; $i<count($aEvents); $i++){
          // echo $i;
          $jItem = $aEvents[$i];
          if($Oldvalue == $jItem->Name ){
            // echo "YES, MATCH";
            $jItem->Name = $Newvalue;            
          }
          elseif($Oldvalue==$jItem->Partners ) {
            $jItem->Partners = $Newvalue;
          }
          elseif($Oldvalue==$jItem->Location ){
            $jItem->Location = $Newvalue;
          }
          elseif($Oldvalue==$jItem->DateTime ){
            $jItem->DateTime = $Newvalue;
          }

        }
        $sEvents = json_encode( $aEvents );
        file_put_contents( 'Event.txt' , $sEvents );
        echo $sEvents;  

    ?>