<?php
require_once("includes/connection.php");
require_once("includes/functions.php");

 $campus_id=$_POST['student_campus_id'];
 $page_no=$_POST['page_no'];
 if(empty($_POST['delete_box'])){
   redirect_to("view_campus_record.php?campus_id={$campus_id}&page_no={$page_no}&checkbox=false");
 
 }
 
 $delete=$_POST['delete_box'];
 


foreach ($delete as $id){
	$student_id=$id;
$account_record=delete_account_informatin($student_id);
  if($account_record !=FALSE){
	
   
	  $academic_record=delelte_student_academic_record($student_id);
  }
   if($academic_record !=FALSE){
	   $genral_record=delete_student_genral_record_by_id($student_id);
   }
   if($genral_record !=FALSE){
	   redirect_to("view_campus_record.php?campus_id={$campus_id}&page_no={$page_no}");
   }

}


?>