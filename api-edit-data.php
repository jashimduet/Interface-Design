<?php

      // Do I need to update something or just display the data
      $sajLetters = file_get_contents('User.txt');
      $ajLetters = json_decode($sajLetters);

      $Oldvalue=$_POST['old'];
      $Newvalue=$_POST['new'];

  
        for($i=0; $i<count($ajLetters); $i++){
          // echo $i;
          $jItem = $ajLetters[$i];
          if($Oldvalue == $jItem->Name ){
            // echo "YES, MATCH";
            $jItem->Name = $Newvalue;            
          }
          elseif($Oldvalue==$jItem->Email ) {
            $jItem->Email = $Newvalue;
          }
          elseif($Oldvalue==$jItem->Mobile ){
            $jItem->Mobile = $Newvalue;
          }

        }
        $sajLetters = json_encode( $ajLetters );
        file_put_contents( 'User.txt' , $sajLetters );
        echo $sajLetters;  

    ?>