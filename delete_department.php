<?php
require_once("includes/connection.php");
require_once("includes/functions.php");

$department_id=$_GET['id'];
$campus_id=$_GET['campus_id'];
$check_record=get_department_record_by_id($department_id);
$check_department_in_campus=get_department_by_its_campus_id($campus_id);

    if($check_department_in_campus==true){
		  if($check_record==true){
			  $delete_department=delete_department($department_id);
			  $delete_campus=delete_campus_by_id($campus_id);
			  if($delete_campus==true && $delete_department==true){
				   redirect_to("add_new_campus.php?department_delete=yes");
			  }else{
				  redirect_to("add_new_campus.php?department_delete=false");
			  }
		  
		  }else{
			  redirect_to("add_new_campus.php?record_exist=yes");
		  }









}else{

if($check_record==true){
	$delete_department=delete_department($department_id);
     if($delete_department==true){
	     redirect_to("add_new_campus.php?department_delete=yes");
	 }else{
		 redirect_to("add_new_campus.php?department_delete=false");
	 }
}else{
	redirect_to("add_new_campus.php?record_exist=yes");
}
	}
?>