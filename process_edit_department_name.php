<?php

require_once("includes/connection.php");
require_once("includes/functions.php");

	
 $department_name=$_POST['department_name'];
 $campus_id=$_POST['campus_id'];
 $department_id=$_POST['department_id'];




     $check_department_exist=get_department_by_name_campus_id($department_name,$campus_id);
	  
	
		 if($check_department_exist==true){
			 
			
		
			 
		$result=update_department_name($department_id,$department_name);
	

	  
	  if($result !=false){
		  user_log_file("RECORD UPDATED",$_SESSION['user_name']."update department name ", "u");
		user_log_file("RECORD UPDATED", "you UPDATE Department name ", "m");
		  redirect_to("add_new_campus.php?dept_update=true");
	  }else{
		  redirect_to("edit_department_name.php?dept_upd=false");
	  }
		 }else{
			 redirect_to("edit_department_name.php?department_exist=true&campus=$campus_id&department=$department_id");
		 }
	


?>