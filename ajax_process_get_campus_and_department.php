<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php

$html="<select name=\"campus\" id=\"campus\" onBlur=\"return validate_campus();\" onChange=\"return get_department();\">
       <option value=\"0\">campus</option>";
	   
	   
   $campus=get_all_campuses();
     while($each_campus=mysql_fetch_array($campus)){
	    $html.="<option value=\"$each_campus[id]\">$each_campus[campus_name]</option>";	 
	 }
	 
   
   	   
	  $html.="</select>";
	  
	
	            
					
					
	  $html.="<span id=\"get_department\"> </span>";
	   
	   echo $html;


   
  

?>