<?php
session_start();
require_once("includes/connection.php");
require_once("includes/functions.php");
  if($_SESSION['logged'] !="true"){
	   
	   redirect_to("index.php?login=false");
   }else{
	   $campus_id=$_POST['campus'];
	  
	   $department=$_POST['department'];
   }
   $result=get_department_name_by_campus_id($campus_id,$department);
   if($result==false){
	   redirect_to("add_new_campus.php?department_exist=true");
   }else{
   $add_department=add_department_in_campus($campus_id,$department);
   if($add_department==TRUE){
	   redirect_to("add_new_campus.php?department_added=true");
   }else{
	   redirect_to("add_new_campus.php?department_added_msg=false");
   }
   }

?>