<?php 
  session_start();
	require_once("includes/connection.php");
	require_once("includes/functions.php");
	if(isset($_SESSION['logged'])!="true"){
		redirect_to("index.php?login=false");
	}else{
		if(isset($_POST['upd_btn'])){
	
	$id=$_POST['member_id'];
	$name=$_POST['name'];
	$father_name=$_POST['father_name'];
    $gender=$_POST['gender'];
	$nic=$_POST['nic'];
	$user_name=$_POST['user_name'];
	$inserted_user_name=$user_name;
	$dob=$_POST['dob'];
    $cell=$_POST['cell_no'];
	$address=$_POST['address'];
	$email=$_POST['email'];
	$existing_user_name=$_POST['existing_user_name'];
	}else{
		redirect_to("update_member_record.php?access=false");
	}
	}//end of checking session condition.
	
	if($user_name==$existing_user_name){  // when  username is not changed.
		$result=update_member_information($id,$name, $father_name,$gender,$nic,$dob,$cell,$address,$email);
		if($result==TRUE){
		redirect_to("my_account.php?update=true");
	}else{
		redirect_to("update_memeber_record.php?update=false");  // When update  is false.
	}
	}else{     //when user name is changed.
	
	$check_user_name_exist=get_memeber_by_user_name($inserted_user_name);
	if($check_user_name_exist==TRUE){
	$result=update_member_record($id, $name, $father_name,$gender,$nic,$user_name,$dob,$cell,$address,$email);
	if($result==TRUE){
		redirect_to("my_account.php?update=true");
	}else{
		redirect_to("update_memeber_record.php?update=false");  // When update  is false.
	}
	}
	else{
		redirect_to("update_member_record.php?user_exist=true"); // user name already exist
			}
	}
	
?>