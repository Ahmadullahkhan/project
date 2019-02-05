<?php
session_start(); 
require_once("includes/connection.php");
require_once("includes/functions.php");






$form_no=$_POST['form_no'];
 $date=$_POST['date'];
$amount=$_POST['amount'];
$reciept_no=$_POST['receipt_no'];
$reciept_date=$_POST['reciept_date'];
 $roll_no=$_POST['roll_no'];
$name=$_POST['name'];
$cnic=$_POST['cnic'];
$date_of_birth=$_POST['date_of_birth'];
	
$father_name=$_POST['father_name'];
$father_cnic=$_POST['father_cnic'];
$gender=$_POST['gender'];
$department=$_POST['department'];
$semester=$_POST['semester'];
$study_program=$_POST['study_program'];
$campus=$_POST['campus'];
$domicile=$_POST['domicile'];
$nationality=$_POST['nationality'];
$religion=$_POST['religion'];
$district=$_POST['district'];
$present_address=$_POST['present_address'];
$permanent_address=$_POST['permanent_address'];
$cell=$_POST['cell'];

$email=$_POST['email'];
$remarks=$_POST['remarks'];
$migrate_semester=$_POST['migrate_semester'];
$ssc_total_marks=$_POST['SSC_total'];
$ssc_obtain_marks=$_POST['SSC_obt'];
$ssc_percentage=($ssc_obtain_marks*100)/$ssc_total_marks;
$ssc_board=$_POST['SSC_board'];

$hssc_total_marks=$_POST['HSSC_total'];
$hssc_obtain_marks=$_POST['HSSC_obt'];
$hssc_board=$_POST['HSSC_board'];
$hssc_percentage=($hssc_obtain_marks*100)/$hssc_total_marks;
$ba_bsc_total_marks=$_POST['BA_BSC_total'];
$ba_bsc_obtain_marks=$_POST['BA_BSC_obt'];
$ba_bsc_board=$_POST['BA_BSC_board'];

$ma_msc_total_marks=$_POST['MA/MSc_total'];
$ma_msc_obtain_marks=$_POST['MA/MSc_obt'];
$ma_msc_board=$_POST['MA/MSc_board'];

$other_total_marks=$_POST['Others_total'];
$other_obtain_marks=$_POST['Others_obt'];
$other_board=$_POST['Others_board'];

$check_record=check_student_exist_by_cnic($cnic);





if ($check_record==TRUE){
	
	 if($ba_bsc_obtain_marks==""){

$genral_information= insert_student_genral_information($name,$cnic,$father_name,$father_cnic,$roll_no,$religion,$nationality,$domicile,$district,$present_address,$permanent_address,$date_of_birth,$cell,$email,$department,$campus,$study_program,$migrate_semester,$gender);
$student_id=mysql_insert_id();


$temp_name=$_FILES['my_file']['tmp_name'];
$target_name=$student_id.".jpg";
$upload_directory="uploads/";
$target_name_distination=$upload_directory.$target_name;
 move_uploaded_file($temp_name,$target_name_distination);

  if ($genral_information==TRUE){
	  $academic_information=insert_student_academic_infromation_fsc($ssc_obtain_marks,$ssc_total_marks,$ssc_percentage,$ssc_board,$hssc_obtain_marks,$hssc_total_marks,$hssc_percentage,$hssc_board,$student_id);
  if ($academic_information==true)
  {
	 $account_information=insert_student_account_information($form_no, $date,$amount,$reciept_no,$reciept_date,$semester,$remarks,$student_id);
  
      if($account_information==TRUE){
		   $user_name=$_SESSION['user_name'];
		  user_log_file("record inserted",$user_name."insert record with id".$student_id,"u");
		  user_log_file("record inserted", "you insert record with id".$student_id,"m");
		  
		  redirect_to("add_student_record.php?record_insert=true");
		  // record inserted.
	  }else{
		  
		  $delete_genral_information = delete_genral_inforamtion ($student_id);
		  $delete_academic_record= delete_academic_information($student_id);
		  if ($delete_academic_record !=FALSE && $delete_genral_information !=FALSE){
		  redirect_to("add_student_record.php?account_record=false");
		   // academic record failed
		  }
		  }
          
  
  
   }else{
	 $reslut=  delet_genral_informtion ($student_id);
	 if($reslut !=FALSE){
	   
	  redirect_to("add_student_record.php?academic_record=false");
	   // academic record failed 
	 }else{
		 
		 redirect_to("add_student_record.php?querry_failed=true");
	 }
	 }
   }else{
	   redirect_to("add_student_record.php?genral_information=false");
	   // student_genral information failed .
   }
	
   
		 
	 }// end of Ba Bsc marks not entered.
	   else if($ma_msc_obtain_marks==""){
		   $ba_bsc_percentage=($ba_bsc_obtain_marks*100)/$ba_bsc_total_marks;
		   

$genral_information= insert_student_genral_information($name,$cnic,$father_name,$father_cnic,$roll_no,$religion,$nationality,$domicile,$district,$present_address,$permanent_address,$date_of_birth,$cell,$email,$department,$campus,$study_program,$migrate_semester,$gender);
$student_id=mysql_insert_id();


$temp_name=$_FILES['my_file']['tmp_name'];
$target_name=$student_id.".jpg";
$upload_directory="uploads/";
$target_name_distination=$upload_directory.$target_name;
 move_uploaded_file($temp_name,$target_name_distination);

   if ($genral_information==TRUE){
	  $academic_information=insert_student_academic_infromation_ba_bsc($ssc_obtain_marks,$ssc_total_marks,$ssc_percentage,$ssc_board,$hssc_obtain_marks,$hssc_total_marks,$hssc_percentage,$hssc_board,$ba_bsc_obtain_marks,$ba_bsc_total_marks,$ba_bsc_percentage,$ba_bsc_board,$student_id);
  if ($academic_information==true)
  {
	 $account_information=insert_student_account_information($form_no, $date,$amount,$reciept_no,$reciept_date,$semester,$remarks,$student_id);
  
      if($account_information==TRUE){
		   $user_name=$_SESSION['user_name'];
		  user_log_file("record inserted",$user_name."insert record with id".$student_id,"u");
		  user_log_file("record inserted", "you insert record with id".$student_id,"m");
		  
		  redirect_to("add_student_record.php?record_insert=true");
		  // record inserted.
	  }else{
		  
		  $delete_genral_information = delete_genral_inforamtion ($student_id);
		  $delete_academic_record= delete_academic_information($student_id);
		  if ($delete_academic_record !=FALSE && $delete_genral_information !=FALSE){
		  redirect_to("add_student_record.php?account_record=false");
		   // academic record failed
		  }
		  }
          
  
  
   }else{
	 $reslut=  delet_genral_informtion ($student_id);
	 if($reslut !=FALSE){
	   
	  redirect_to("add_student_record.php?academic_record=false");
	   // academic record failed 
	 }else{
		 
		 redirect_to("add_student_record.php?querry_failed=true");
	 }
	 }
   }else{
	   redirect_to("add_student_record.php?genral_information=false");
	   // student_genral information failed .
   }
	
   
		   
		   
	   }//end of  if Ma MSc record not inserted.
	   
	   else if($other_obtain_marks==""){
		 $ba_bsc_percentage=($ba_bsc_obtain_marks*100)/$ba_bsc_total_marks;
		 $ma_msc_percentage=($ma_msc_obtain_marks*100)/$ma_msc_total_marks;
		   

$genral_information= insert_student_genral_information($name,$cnic,$father_name,$father_cnic,$roll_no,$religion,$nationality,$domicile,$district,$present_address,$permanent_address,$date_of_birth,$cell,$email,$department,$campus,$study_program,$migrate_semester,$gender);
$student_id=mysql_insert_id();


$temp_name=$_FILES['my_file']['tmp_name'];
$target_name=$student_id.".jpg";
$upload_directory="uploads/";
$target_name_distination=$upload_directory.$target_name;
 move_uploaded_file($temp_name,$target_name_distination);

   if ($genral_information==TRUE){
	 $academic_information=insert_student_academic_infromation_ma_msc($ssc_obtain_marks,$ssc_total_marks,$ssc_percentage,$ssc_board,$hssc_obtain_marks,$hssc_total_marks,$hssc_percentage,$hssc_board,$ba_bsc_obtain_marks,$ba_bsc_total_marks,$ba_bsc_percentage,$ba_bsc_board,$ma_msc_obtain_marks,$ma_msc_total_marks,$ma_msc_percentage,$ma_msc_board,$student_id);
  if ($academic_information==true)
  {
	 $account_information=insert_student_account_information($form_no, $date,$amount,$reciept_no,$reciept_date,$semester,$remarks,$student_id);
  
      if($account_information==TRUE){
		   $user_name=$_SESSION['user_name'];
		  user_log_file("record inserted",$user_name."insert record with id".$student_id,"u");
		  user_log_file("record inserted", "you insert record with id".$student_id,"m");
		  
		  redirect_to("add_student_record.php?record_insert=true");
		  // record inserted.
	  }else{
		  
		  $delete_genral_information = delete_genral_inforamtion ($student_id);
		  $delete_academic_record= delete_academic_information($student_id);
		  if ($delete_academic_record !=FALSE && $delete_genral_information !=FALSE){
		  redirect_to("add_student_record.php?account_record=false");
		   // academic record failed
		  }
		  }
          
  
  
   }else{
	 $reslut=  delet_genral_informtion ($student_id);
	 if($reslut !=FALSE){
	   
	  redirect_to("add_student_record.php?academic_record=false");
	   // academic record failed 
	 }else{
		 
		 redirect_to("add_student_record.php?querry_failed=true");
	 }
	 }
   }else{
	   redirect_to("add_student_record.php?genral_information=false");
	   // student_genral information failed .
   }
	
   
		   
	   } // end of if Other record not inserted.
	
	else{
		
		$ba_bsc_percentage=($ba_bsc_obtain_marks*100)/$ba_bsc_total_marks;
		 $ma_msc_percentage=($ma_msc_obtain_marks*100)/$ma_msc_total_marks;
		$other_percentage=($other_obtain_marks*100)/$other_total_marks; // other percentagge
		
$genral_information= insert_student_genral_information($name,$cnic,$father_name,$father_cnic,$roll_no,$religion,$nationality,$domicile,$district,$present_address,$permanent_address,$date_of_birth,$cell,$email,$department,$campus,$study_program,$migrate_semester,$gender);
$student_id=mysql_insert_id();


$temp_name=$_FILES['my_file']['tmp_name'];
$target_name=$student_id.".jpg";
$upload_directory="uploads/";
$target_name_distination=$upload_directory.$target_name;
 move_uploaded_file($temp_name,$target_name_distination);

   if ($genral_information==TRUE){
	  $academic_information=insert_student_academic_infromation($ssc_obtain_marks,$ssc_total_marks,$ssc_percentage,$ssc_board,$hssc_obtain_marks,$hssc_total_marks,$hssc_percentage,$hssc_board,$ba_bsc_obtain_marks,$ba_bsc_total_marks,$ba_bsc_percentage,$ba_bsc_board,$ma_msc_obtain_marks,$ma_msc_total_marks,$ma_msc_percentage,$ma_msc_board,$other_obtain_marks,$other_total_marks,$other_percentage,$other_board ,$student_id);
  if ($academic_information==true)
  {
	 $account_information=insert_student_account_information($form_no, $date,$amount,$reciept_no,$reciept_date,$semester,$remarks,$student_id);
  
      if($account_information==TRUE){
		   $user_name=$_SESSION['user_name'];
		  user_log_file("record inserted",$user_name."insert record with id".$student_id,"u");
		  user_log_file("record inserted", "you insert record with id".$student_id,"m");
		  
		  redirect_to("add_student_record.php?record_insert=true");
		  // record inserted.
	  }else{
		  
		  $delete_genral_information = delete_genral_inforamtion ($student_id);
		  $delete_academic_record= delete_academic_information($student_id);
		  if ($delete_academic_record !=FALSE && $delete_genral_information !=FALSE){
		  redirect_to("add_student_record.php?account_record=false");
		   // academic record failed
		  }
		  }
          
  
  
   }else{
	 $reslut=  delet_genral_informtion ($student_id);
	 if($reslut !=FALSE){
	   
	  redirect_to("add_student_record.php?academic_record=false");
	   // academic record failed 
	 }else{
		 
		 redirect_to("add_student_record.php?querry_failed=true");
	 }
	 }
   }else{
	   redirect_to("add_student_record.php?genral_information=false");
	   // student_genral information failed .
   }
	}
	
   }else {
	redirect_to("add_student_record.php?student_exist=false"); // student record exist	
}



?>