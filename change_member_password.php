<?php 
   session_start();
	require_once("includes/connection.php");
	require_once("includes/functions.php");
	if($_SESSION['logged']!="true"){
		redirect_to("index.php?login=false");
	}
	if(isset($_GET['change_password'])&& ($_GET['change_password']=="false")){
	  $change_password_message="password not change";
	}else{
	     $change_password_message=NULL;
	}
	$id=$_GET['id'];
	$result=get_member_information_by_id($id);
	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Student Information System</title>
<link href="stylesheets/reset.css" rel="stylesheet" type="text/css" />
<link href="stylesheets/layout.css" rel="stylesheet" type="text/css" />
<link href="stylesheets/style.css" rel="stylesheet" type="text/css" />
<link href="stylesheets/table_style.css" rel="stylesheet" type="text/css" />
<link href="stylesheets/form_style.css" rel="stylesheet" type="text/css" />
<link href="stylesheets/jquery-ui.css" rel="stylesheet" type="text/css" />
<script type="text/javascript"></script>
<script type="application/javascript" src="scripts/jquery/jquery-1.8.3.js"></script>
<script type="text/javascript" src="scripts/jquery/jquery-ui.js"></script>
<script>



function validate_password_form(){
	
	var current_password=check_current_password();
	var new_password=check_password();
	
	if(current_password==true && new_password==true){
		return true;
	}else{
		return false;
	}
}

function check_password(){
		
	var new_password =document.getElementById("new_password").value;
	var confirm_password=document.getElementById("confirm_new_password").value;
	
	 if(new_password !=confirm_password){
		 document.getElementById("password_missmatch").innerHTML="password MisMatch";
		 return false;
	}
	document.getElementById("password_missmatch").innerHTML="";
	return true;
}

function check_current_password(){
	
	var old_password=document.getElementById("old_password").value;
	var entered_password=document.getElementById("entered_password").value;
	  if(old_password !=entered_password){
		  document.getElementById("current_password").innerHTML="Wrong Password";
		  return false;
	  }
	  document.getElementById("current_password").innerHTML="";
	return true;	  
}
   

</script>
</head>
<body>
<div id="container">
<?php include_once("includes/header.php"); ?>
<div id="content">



<div id="main_content">
	<h1>Change Password</h1>
    
     <div id="error_p" ><?php  
		 ?> </div>
     
 		<br />
     
     <table class="std_detail_info_table">
     <caption>Member General Information</caption>
     	<tr>
        	<td class="std_detail_side_labels" style="border-radius:8px 0 0 0;">Name:</td>
            <td class="std_detail_values"><?php echo $result['name'];  ?></td>
            <td class="std_detail_side_labels">Father Name:</td>
            <td class="std_detail_values" style="border-radius:0 8px 0px 0px;"><?php echo $result['father_name']; ?></td>
        </tr>
     	<tr>
     	  <td class="std_detail_side_labels">Gender:</td>
     	  <td class="std_detail_values"><?php if($result['gender']=="m") echo male; else echo female  ?></td>
     	  <td class="std_detail_side_labels">CNIC:</td>
     	  <td class="std_detail_values"><?php echo $result['nic']; ?></td>
   	  </tr>
     	<tr>
     	  <td class="std_detail_side_labels" style="border-radius:0 0 0 8px">User Name:</td>
     	  <td class="std_detail_values"><?php echo $result['user_name']; ?></td>
     	  <td class="std_detail_side_labels">Date of Birth</td>
     	  <td class="std_detail_values" style="border-radius: 0 0 8px 0px"><?php echo $result['dob']; ?></td>
   	  </tr>
     	
 
    
      </table>
     
     <br />
     
     <br />
     
     <table  class="std_detail_info_table">
     <caption>
     Contact Information
     </caption>
     	<tr>
        	<td class="std_detail_side_labels" style="border-radius:8px 0 0 0;">Cell no:</td>
            <td class="long_row" style="border-radius:0 8px 0px 0px;"><?php echo $result['cell_no']; ?></td>
        </tr>
     	<tr>
     	  <td class="std_detail_side_labels"> Address:</td>
     	  <td class="long_row"><?php echo $result['address'];  ?></td>
   	    </tr>
     	<tr>
     	  <td class="std_detail_side_labels" style="border-radius:0px 0px 0px 8px;">Email:</td>
     	  <td class="long_row" style="border-radius:0 0 8px 0px;"><?php echo  $result['email'];  ?></td>
   	  </tr>
     </table>
    
    
    
   <form name="change_password_form" method="post" action="process_change_password.php" onsubmit="return validate_password_form();">
     <table  class="std_detail_info_table" style="margin-top:12px">
     <caption>
     Password Information
     </caption>
     	<tr>
        	<td class="std_detail_side_labels" style="border-radius:8px 0 0 0;">Current Password:</td>
            <td class="long_row" style="border-radius:0 8px 0px 0px;"><input type="password" name="current_password" onblur="return check_current_password();" id="entered_password" /><span id="current_password"> </span></td>
        </tr>
     	<tr>
     	  <td class="std_detail_side_labels">New Password:</td>
     	  <td class="long_row"><input type="password" name="new_password" id="new_password"/></td>
          
   	    </tr>
     	<tr>
     	  <td class="std_detail_side_labels" style="border-radius:0px 0px 0px 8px;">Confirm Password</td>
     	  <td class="long_row" style="border-radius:0 0 8px 0px;"><input type="password" name="confirm_new_password" id="confirm_new_password" onblur="return check_password();" /><span id="password_missmatch"></span></td>
          <input type="hidden" name="old_password" value="<?php echo $result['password'];?>" id="old_password" />
         <input type="hidden" name="id" value="<?php echo $result['id'];  ?>"
          
          
   	  </tr>
    
     </table>
     <p align="center"><input type="submit" name="udp_password_btn" value="Change Password"  class="action_btns" /><?php   ?></p>
   </form>
     
	
      
</div><!--end of main_content -->





</div><!--end of content -->
</div><!--end of container -->
<?php include_once("includes/footer.php");?>
</body>
</html>
<?php mysql_close($connection); ?>