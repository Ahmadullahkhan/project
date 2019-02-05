<?php 
   session_start();
	require_once("includes/connection.php");
	require_once("includes/functions.php");
	

	if(isset($_GET['id'])){
		
	   $page_no=$_GET['page_no'];
	
		
		$id = $_GET['id'];
		$del_genral_information = delete_student_genral_record_by_id($id);
		//delete genral information.
		if($del_genral_information != FALSE){
			
			$del_academic_information= delelte_student_academic_record($id);
			
		
		
		if($del_academic_information ==TRUE){
			$del_account_information=delete_account_informatin($id);
			
		if($del_account_information==TRUE){
			
		user_log_file("record deleted",$user_name."delete record of student with id  ".$id,"u");
			user_log_file("record deleted"," you delete record of student with id  ".$id,"m");
			 redirect_to("view_all_campuses_record.php?page_no=$page_no");
			
		 }else{
			  redirect_to("view_all_campuses_record.php?del_accont=false&page_no=$page_no");
			  }
		
		 }else{
			redirect_to("view_all_campuses_record.php?del_accont=false&page_no=$page_no");
		     }
	     }else{
		    redirect_to("view_all_campuses_record.php?del_accont=false&page_no=$page_no");
		 }
	         }else{
		redirect_to("view_all_campuses_record.php?valid=false");
	}
?>