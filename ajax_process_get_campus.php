<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php

$html="<select name=\"campus\" id=\"campus\" onchange=\"return validate_campus_select();\">
       <option value=\"0\">campus</option>";
	   
	   
   $campus=get_all_campuses();
     while($each_campus=mysql_fetch_array($campus)){
	    $html.="<option value=\"$each_campus[id]\">$each_campus[campus_name]</option>";	 
	 }
	 
   
   	   
	  $html.="</select>";
	  $html.="<input type=\"submit\" name=\"submit_edit_button\" value=\"Edit\" class=\"add_campus_btn\">";
	   
	   echo $html;


   
  

?>