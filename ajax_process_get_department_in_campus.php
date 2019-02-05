<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php
$campus_id=$_GET['campus_id'];
   $department=get_department_of_this_campus_id($campus_id);
   
     if($department !=false){
		 $html="<select name=\"department\" id=\"department\" onchange=\"return validate_department();\">
		              <option value=\"0\">Department</option>";
		       
		
		 
		 while($each_department=mysql_fetch_array($department)){
		   $html.=  "<option value=\"$each_department[id]\">$each_department[department_name]</option>";
		 }
		    $html.="</select>";
		   $html.="<input type=\"submit\" name=\"submit_edit_button\" value=\"Edit\" class=\"add_campus_btn\">";
		 echo $html;
	
	 }

?>