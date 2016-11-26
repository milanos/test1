<?php
if (
	(date("N")<6) AND //  nie jest to weekend
	(date("H")>=8) AND //od 08:00
	(date("H")<21) //do 21 
	){
		tab('OK');
	}	
	
function tab($tab,$tekst=''){
          if ($tekst){
             echo '<hr />';
             echo "<h3>{$tekst}</h3>";
          }
           echo '<pre>';
           print_r($tab);
           echo '</pre>';
          if ($tekst){echo '<hr />';}
}	
?>