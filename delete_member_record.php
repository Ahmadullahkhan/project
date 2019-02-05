<?php
 session_start();
	require_once("includes/connection.php");
	require_once("includes/functions.php");
	
	if($_SESSION['logged']!="true"){
 redirect_to("index.php?login=false");
	}


$id=$_GET['id'];

  $result=Delete_member_record_by_id($id);
  
  if($result !=false)
  {
	  redirect_to("view_site_member.php?record_delete=true");
  }else{
	   redirect_to("view_site_member.php?record_delete=false");
  }
	  
  
  

?>