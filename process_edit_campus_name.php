<?php
require_once("includes/connection.php");
require_once("includes/functions.php");




 $campus_id=$_POST['campus_id'];
 $campus_name=$_POST['campus_name'];
 $old_name=$_POST['old_name'];

 if($campus_name==$old_name){
 redirect_to("edit_campus_name.php?campus=$campus_id&no_change=true");
 }
 
 
 
 
 
 $campus_exist=get_campus_by_name($campus_name);
 if($campus_exist==true){

$result=update_campus_name($campus_id,$campus_name);
if($result==true){
	user_log_file("RECORD UPDATED",$_SESSION['user_name']."update campus name  ", "u");
		user_log_file("RECORD UPDATED", "you UPDATE Campus Name  ", "m");
     redirect_to("add_new_campus.php?campus_update=true");
}else{
	redirect_to("add_new_campus.php?campus_upd=false");
}
 }else{
	 redirect_to("edit_campus_name.php?campus=$campus_id&campus_exist=true");
 }

?>
