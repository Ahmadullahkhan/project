<?php 
 session_start();
	require_once("includes/connection.php");
	require_once("includes/functions.php");
	
	if(!isset($_POST['add_btn'])&&($_SESSION['logged']!="true")){
		
		redirect_to("add_site_member.php?access=false;");
	}else{
	   
	   $name=$_POST['name'];
	   $father_name=$_POST['father_name'];
	   $gender=$_POST['gender'];
	   $nic=$_POST['nic'];
	   $user_name=$_POST['user_name'];
	   $email=$_POST['email'];
	   $password=$_POST['password'];
	   $address=$_POST['address'];
	   $cell_no=$_POST['cell_no'];
	}
   $check_member_exist=get_memeber_by_user_name($user_name);
   if($check_member_exist==TRUE){
   $result=insert_site_member_information($name,$father_name,$gender,$address,$nic,$user_name,$email,$password,$cell_no);
   
      if($result==TRUE){
		  user_log_file("site member added","you added a site member:".$name,"m");
		  user_log_file("site member added", $_SESSION['user_name']." added a site member:".$name,"u");
		  
		  redirect_to("add_site_member.php?member_added=true");
		  
	  }else{
		   redirect_to("add_site_member.php?member_added=false");
	  }
   }else{
	   redirect_to("add_site_member.php?member_exist=true");
   }
	

?>