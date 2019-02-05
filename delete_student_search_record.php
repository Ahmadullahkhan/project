<?php 
   session_start();
	require_once("includes/connection.php");
	require_once("includes/functions.php");
	

	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$search_by=$_POST['search_by'];
  	    $search=$_POST['search'];
	    $campus=$_POST['campus'];
	    $department=$_POST['department'];
	    $search_type=$_POST['search_type'];
		
		$del_genral_information = delete_student_genral_record_by_id($id);
		//delete genral information.
		if($del_genral_information != FALSE){
			
			$del_academic_information= delelte_student_academic_record($id);
			
		
		
		if($del_academic_information ==TRUE){
			$del_account_information=delete_account_informatin($id);
			
		if($del_account_information==TRUE){
			
		user_log_file("record deleted",$user_name."delete record of student with id  ".$id,"u");
			user_log_file("record deleted"," you delete record of student with id  ".$id,"m");
			 redirect_to("process_search.php?del=true");
			
		 }else{
			  redirect_to("view_student_summary.php?del_accont=false");
			  }
		
		 }else{
			redirect_to("view_student_detail.php?id=$id & del_academic_info=false");
		     }
	     }else{
		    redirect_to("view_student_summary.php?id=$id & genral_info=false");
		 }
	         }else{
		redirect_to("view_summary.php?valid=false");
	}
?>