<?php
   session_start();
	require_once("includes/connection.php");
	require_once("includes/functions.php");
	
	  if($_SESSION['logged'] !="true"){
	   
	   redirect_to("index.php?login=false");
   }
	

	if(isset($_POST['upd_btn'])){
		 $id=$_POST['id'];
		
	    $name=$_POST['std_name'];
		$cnic=$_POST['cnic'];
		$father_name=$_POST['father_name'];
		$father_cnic=$_POST['father_cnic'];
		$gender=$_POST['gender'];
		$roll_no=$_POST['roll_no'];
		$relegion=$_POST['religion'];
		$nationality=$_POST['nationality'];
		$domicile=$_POST['domicile'];
		$district=$_POST['district'];
		$present_address=$_POST['present_address'];
		$permanent_address=$_POST['permanent_address'];
		$dob=$_POST['dob'];
		$cell=$_POST['cell'];
		$email=$_POST['email'];
	    $department=$_POST['department'];
	    $campus=$_POST['campus'];
	    $study_program=$_POST['study_program'];
		$account_id=$_POST['account_id'];
		
		$receipt_no=$_POST['receipt_no'];
		$receipt_date=$_POST['receipt_date'];
		$form_no=$_POST['form_no'];
		$amount=$_POST['amount'];
		$semester=$_POST['semester'];
		$ssc_obtain_marks=$_POST['ssc_obtain_marks'];
	 	$ssc_total_marks=$_POST['ssc_total_marks'];
		$ssc_board=$_POST['ssc_board'];
		$ssc_percentage=($ssc_obtain_marks*100)/$ssc_total_marks;
		$hssc_obtain_marks=$_POST['hssc_obtain_marks'];
		$hssc_total_marks=$_POST['hssc_total_marks'];
		$hssc_board=$_POST['hssc_board'];
		$hssc_percentage=($hssc_obtain_marks*100)/$hssc_total_marks;
		  if(isset($_POST['ba_bsc_obtain_marks'])){
		$ba_bsc_obtain_marks=$_POST['ba_bsc_obtain_marks'];
		$ba_bsc_total_marks=$_POST['ba_bsc_total_marks'];
		$ba_bsc_board=$_POST['ba_bsc_board'];
		$ba_bsc_percentage=($ba_bsc_obtain_marks*100)/$ba_bsc_total_marks;
		
		  }
		  
		 if(isset($_POST['ma_msc_obtain_marks'])){ 
		$ma_msc_obtain_marks=$_POST['ma_msc_obtain_marks'];
		$ma_msc_total_marks=$_POST['ma_msc_total_marks'];
		$ma_msc_board=$_POST['ma_msc_board'];
		$ma_msc_percentage=($ma_msc_obtain_marks*100)/$ma_msc_total_marks;
		
		 }
	
		 if(isset($_POST['other_obtain_marks'])){ 
		$other_obtain_marks=$_POST['other_obtain_marks'];
		$other_total_marks=$_POST['other_total_marks'];
		$other_board=$_POST['other_board'];
	    $other_percentage=($other_obtain_marks*100)/$other_total_marks;
		
		 }			 
			 
			
		

		  $update_genral_record = update_student_genral_information_record($id,$name,$cnic,$father_name,$father_cnic,$gender,$roll_no,$relegion,$nationality,$domicile,$district,$present_address,$permanent_address,$dob,$cell,$email,$department,$campus,$study_program);
		  
		 if ($update_genral_record != FALSE)
	     {
		  $update_account_record= update_account_record($account_id,$receipt_no,$receipt_date,$form_no,$amount,$semester);
		   
		   if ($update_account_record !=FALSE){
			      if(!isset($ba_bsc_obtain_marks)&&(!isset($ma_msc_obtain_marks))&& (!isset($other_obtain_marks))){
					  
					   $update_academic_record=update_academic_record_fsc_fa($ssc_obtain_marks,$ssc_total_marks,$ssc_percentage,$ssc_board,$hssc_obtain_marks,$hssc_total_marks,$hssc_percentage,$hssc_board,$id);
					  
					 
				  }else if(!isset($ma_msc_obtain_marks)&& (!isset($other_obtain_marks))){
					  
					   $update_academic_record=update_academic_record_fa_fsc_ba_bsc($ssc_obtain_marks,$ssc_total_marks,$ssc_percentage,$ssc_board,$hssc_obtain_marks,$hssc_total_marks,$hssc_percentage,$hssc_board,$ba_bsc_obtain_marks,$ba_bsc_total_marks,$ba_bsc_percentage,$ba_bsc_board,$id);
				
				}else if (!isset($other_obtain_marks)){
					 $update_academic_record=update_academic_record_fa_fsc_ba_bsc_ma_msc($ssc_obtain_marks,$ssc_total_marks,$ssc_percentage,$ssc_board,$hssc_obtain_marks,$hssc_total_marks,$hssc_percentage,$hssc_board,$ba_bsc_obtain_marks,$ba_bsc_total_marks,$ba_bsc_percentage,$ba_bsc_board,$ma_msc_obtain_marks,$ma_msc_total_marks,$ma_msc_percentage,$ma_msc_board,$id);
					
				}else{
				  
				
			   $update_academic_record=update_academic_record($ssc_obtain_marks,$ssc_total_marks,$ssc_percentage,$ssc_board,$hssc_obtain_marks,$hssc_total_marks,$hssc_percentage,$hssc_board,$ba_bsc_obtain_marks,$ba_bsc_total_marks,$ba_bsc_percentage,$ba_bsc_board,$ma_msc_obtain_marks,$ma_msc_total_marks,$ma_msc_percentage,$ma_msc_board,$other_obtain_marks,$other_total_marks,$other_percentage,$other_board ,$id);
				}
  if($update_academic_record !=FALSE){
	 $username=$_SESSION['user_name'];
	user_log_file("record updated",$username."update record of student id=".$id,"u");
	user_log_file("record updated","You update record of student id=".$id,"m");
    redirect_to("view_student_details.php?id=$id&upd=true");
	}else{
		redirect_to("update_student_record.php?upd_academic_record=false&id=$id");
		}

			   
		}else{
		redirect_to("update_student_record.php?upd_account_record=false & id=$id");   
		    }
		  
		  
		  
		}else{
			redirect_to("update_stuent_record.php?upd_genral_info=false & id=$id");		 
		}
		 
		 
	}    //end of ifis set function 
	else{
		redirect_to("update_student_record.php");
	}

?>


