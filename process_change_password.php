<?php
session_start();
require_once("includes/connection.php");
require_once("includes/functions.php");
if($_SESSION['logged'] !="true"){
	redirect_to("index.php?login=false");
}
if(isset($_POST['udp_password_btn'])){
$id=$_POST['id'];
$new_password=$_POST['new_password'];

$result=change_password($id,$new_password);

if($result==TRUE){
	redirect_to("my_account.php?change_password=true");
   }else{
     redirect_to("my_account.php?change_password=false");
   }
}
	


?>