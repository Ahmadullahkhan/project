<?php
session_start();
require_once("includes/connection.php");
require_once("includes/functions.php");
if($_SESSION['logged'] !="true"){
	   
	   redirect_to("index.php?login=false");
   }
   
   if(!isset($_POST['add_new_campusbtn'])){
    redirect_to("add_new_campus.php?access=false");
   }else{
      $campus_name=$_POST['new_campus'];
	  $department_name=$_POST['new_department'];
	  
	  $check_campus=get_campus_by_name($campus_name);
	  
	  if($check_campus==FALSE){
		  redirect_to("add_new_campus.php?campus_exist=true");
	  }

   }
   
   
   
   
  $new_campus=add_new_campus($campus_name);
  if($new_campus==TRUE){
     $campus_id=mysql_insert_id();

	  $new_department=add_new_department($department_name,$campus_id);
	  if($new_department=TRUE){
		  
		  redirect_to("add_new_campus.php?campus_added=true");
	  }else{
		  	  
	  }
  }else{
	  redirect_to("add_new_campus.php?result=false");
  }

?>