<?php
session_start();
require_once("includes/connection.php");
require_once("includes/functions.php");

$id=$_POST['id'];
$reciept_no=$_POST['reciept_no'];
$reciept_date=$_POST['reciept_date'];
$form_no=$_POST['form_no'];
$amount=$_POST['amount'];
$semester=$_POST['semester'];

$add_account_record=add_account_record($id,$reciept_no,$reciept_date,$form_no,$amount,$semester);

if($add_account_record==TRUE){
	user_log_file("account record Added"," you insert account record of student with id ".$id,"m");
	user_log_file("record deleted",$user_name."insert account record of student with id  ".$id,"u");
	redirect_to("view_student_details.php?id=$id&account_record_insertion=true");
}else{
	redirect_to("view_student_details.php?id=$id&account_record_insertion=false");
}


?>