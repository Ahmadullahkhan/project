<?php
require_once ("includes/connection.php");
require_once ("includes/functions.php");
if(isset($_POST['login_btn'])){
	 $user_name = $_POST['user_name'];
	 $password =  $_POST['password'];
	 $login_result  = login_member($user_name,$password);
	 if($login_result == TRUE){
		redirect_to("home.php");	 
	 }else{
		redirect_to("index.php?login=false");
	 }
}else{
	 redirect_to("index.php?login=false");
}




?>