<?php
session_start();
require_once("includes/connection.php");
require_once("includes/functions.php");

$result=log_out_member();
   if($result ==TRUE){
	 
	   redirect_to("index.php");
   }else{
	   redirect_to("home.php?loged=false");
   }

?>