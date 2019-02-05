<?php
session_start();
	require_once("includes/connection.php");
	require_once("includes/functions.php");
   
   if($_SESSION['logged'] !="true"){
	   
	   redirect_to("index.php?login=false");
   }
   if(isset($_GET['member_added'])&&($_GET['member_added']=="true")){
	   $notify="Member added successfully";
   }else{
	   $notify=NULL;
   }
    if(isset($_GET['member_added'])&&($_GET['member_added']=="false")){
	  $message="Member not added";
   }else{
	   $message=NULL;
   }
   
   if(isset($_GET['member_exist'])&& ($_GET['member_exist'])=="true"){
         $member_exist_message="This User Name already exist";
   }
   
   
   
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
<script type="text/javascript" src="scripts/validate_site_member.js"></script>
<script type="application/javascript" src="scripts/jquery/jquery-1.8.3.js"></script>
<script type="text/javascript" src="scripts/jquery/jquery-ui.js"></script>
<script>

$(function(){
		//Script for Date Picker.......
			$("#dob").datepicker({
				dateFormat:'yy-mm-dd',
			    gotoCurrent: true,
			    showAnim: 'fold',
				
				changeMonth: true,
				changeYear: true,
				
			});
});
</script>
</head>
<body>
<div id="container">
<?php include_once("includes/header.php"); ?>
<div id="content">



<div id="main_content">
	<h1>Add Site Member</h1>
    <div id="error_p" ><?php echo $notify; echo  $message;echo $member_exist_message; ?> </div>
    
    <form name="add_site_member" method="post" action="process_add_site_member.php" onsubmit="return validate_member_record();"> 
       <table width="679" class="form_table">
          <caption id="caption">Member Information</caption>
          <tr>
            <td width="113" class="form_table_labels" style="border-radius:8px 0px 0px 0px">Name:</td>
            <td width="219" class="form_table_marks"><input type="text" name="name" id="name" onblur="validate_member_name();" onkeyup="return validate_member_name_spot();"/></td>
            
           <td width="127"class="form_table_labels">Father Name:</td>
           <td width="287" class="form_table_marks" style="border-radius:0px 8px 0px 0px"><input type="text" name="father_name" id="father_name" onkeyup="validate_father_name_spot();" onblur="validate_father_name();" /></td>
         </tr>
         
         <tr>
            <td class="form_table_labels"> Gender:</td>
            <td class="form_table_marks"><select name="gender" class="gender">
                
                <option value="M" selected="selected">Male</option>
                <option value="F">Female</option>
                </select>
            </td>
             <td class="form_table_labels">NIC:</td>
             <td class="form_table_marks"><input type="text" name="nic" id="cnic" onblur="return validate_cnic();" onkeyup="return validate_cnic_char()" onkeydown="return add_dashes_to_nic_no();"/></td>
       </tr>
       <tr>
         <td class="form_table_labels">User Name:</td>
         <td class="form_table_marks"><input type="text" name="user_name" id="user_name" onkeyup="return validate_user_name();" /></td>
         <td class="form_table_labels">Email:</td>
         <td class="form_table_marks"><input type="text" name="email" id="email" onblur="return validate_email();" onkeyup="return validate_email_char();"/></td>
         
      </tr>
      <tr >
         <td class="form_table_labels">Password:</td>
         <td class="form_table_marks"><input type="password" name="password" class="pass_textbox" id="new_password" onkeyup="return validate_password();"  value=""/></td>
         <td class="form_table_labels">Repeat Password:</td>
         <td class="form_table_marks"><input type="password" name="repeat_password" class="pass_textbox" id="repeat_password" onblur="return check_new_password_match();" onkeyup="return validate_new_password();" /><span id="password_error_message"> </span></td>
      </tr>
      
       <tr >
         <td class="form_table_labels">DOB:</td>
         <td class="form_table_marks"><input type="text" name="dob"  id="dob" onkeyup="return validate_dob();"  value="2005-04-17" readonly="readonly"/></td>
         <td class="form_table_labels">Cell NO:</td>
         <td class="form_table_marks"><input type="text" name="cell_no" id="cell_no" onblur="return validate_cell_no();" onkeydown="return add_dashes_cell_no();" onkeyup="return validate_cell_char();"/></td>
      </tr>
      
       <tr>
          <td class="form_table_labels" style="border-radius:0px 0px 0px 8px">Address:</td>
          <td class="form_table_marks"><input type="text" name="address" id="address" onkeyup="return validate_address();"/></td>
          <td class="form_table_labels">&nbsp;</td>
          <td class="form_table_marks" style="border-radius:0px 0px 8px 0px">&nbsp;</td>
      </tr>
	</table>
    <p align="center"><input type="submit" name="add_btn" value="Add Member" class="action_btns"/></p> 
    </form>  
</div><!--end of main_content -->





</div><!--end of content -->
</div><!--end of container -->
<?php include_once("includes/footer.php");?>
</body>
</html>
<?php mysql_close($connection); ?>