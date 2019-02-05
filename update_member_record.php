<?php 
  session_start();
	require_once("includes/connection.php");
	require_once("includes/functions.php");
	if($_SESSION['logged']!="true"){
	 redirect_to("index.php?login=false");
	}
	
    $id=$_SESSION['member_id'];
	$result=get_member_information_by_id($id);
	if(isset($_GET['update'])&&($_GET['update'])=="false"){
	$update_message="Record not updated";
	}else{
	$update_message=NULL;
	}
	if(isset($_GET['user_exist'])&&($_GET['user_exist']=="true")){
		$user_exist_message="This User Name already Exist";
	}else{
	$user_exist_message=NULL;
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
<link href="stylesheets/form_style.css" rel="stylesheet" type="text/css" />
<link href="stylesheets/jquery-ui.css" rel="stylesheet" type="text/css" />
<script type="text/javascript"></script>
<script type="text/javascript" src="scripts/validate_member_record.js"> </script>
<script type="application/javascript" src="scripts/jquery/jquery-1.8.3.js"></script>
<script type="text/javascript" src="scripts/jquery/jquery-ui.js"></script>
<script>

 $( function(){
	  	$("#dob").datepicker({
				dateFormat:'yy-mm-dd',
			    gotoCurrent: true,
			    showAnim: 'fold',
				
				changeMonth: true,
				changeYear: true,
				minDate: -0, 
				maxDate: "+2M +10D",
			});
	   }
	  
   );


   function confirm_del(){
		var del = confirm("Are you sure you want to delete this record?");
		return del;   
   }
  
   
   function change_password(){
	   var current_password="<input type=\"password\" name=\"current_password\" />";
	   var New_password="<input type=\"password\" name=\"password\" />";
	   var repeat_password="<input type=\"password\" name=\"repeat_password\" />";
	   
	   document.getElementById("current_password").value=current_passowrd;
   }
   
</script>
</head>
<body>
<div id="container">
<?php include_once("includes/header.php"); ?>
<div id="content">



<div id="main_content">
 	 <h1> Welcome <?php echo $_SESSION['name']; ?></h1>
 		<br />
         <div id="error_p" ><?php
		  echo $update_message;
		   echo $user_exist_message; 
		 
		   
		 ?> </div>
     
  <form name="update_member_information" method="post" action="process_update_member_record.php" onsubmit="return validate_member_record();" >   
     <table class="std_detail_info_table">
     <caption>Member General Information<span class="right_caption"> 
     </span></caption>
     	<tr>
        	<td class="std_detail_side_labels" style="border-radius:8px 0 0 0;">Name:</td>
            <td class="std_detail_values"><input type="text" name="name"value="<?php echo $result['name'];  ?>" id="name" onkeyup="return validate_member_name();"/></td>
            <td class="std_detail_side_labels">Father Name:</td>
            <td class="std_detail_values" style="border-radius:0 8px 0px 0px;"><input type="text" name="father_name" value="<?php echo $result['father_name']; ?>"   id="father_name" onkeyup="return validate_father_name();"/></td>
        </tr>
     	<tr>
     	  <td class="std_detail_side_labels">Gender:</td>
     	  <td class="std_detail_values"><select name="gender" id="gender" >
          <option value="M" <?php if($result['gender']=="M" ){ echo "selected=\"selected\" ";}?> > Male</option> 
          <option value="F" <?php if($result['gender']=="F") {echo "selected=\"selected\" ";   } ?> >Female </option>
          </select>  </td>
     	  <td class="std_detail_side_labels">CNIC:</td>
     	  <td class="std_detail_values"><input type="text" name="nic" value="<?php echo $result['nic']; ?>" onkeyup="return check_cnic_char();"  onkeydown="return add_dashes_to_std_nic_no();"id="cnic_char" /></td>
   	  </tr>
     	<tr>
     	  <td class="std_detail_side_labels" style="border-radius:0 0 0 8px">User Name:</td>
     	  <td class="std_detail_values"><input type="text" name="user_name" value="<?php echo $result['user_name']; ?>" id="user_name" onkeyup="return validate_user_name();" /></td>
     	  <td class="std_detail_side_labels">Date of Birth</td>
     	  <td class="std_detail_values" style="border-radius: 0 0 8px 0px"><input type="text" name="dob" value="<?php echo $result['dob']; ?>" id="dob" onkeyup="return validate_dob();" /></td>
   	  </tr>
      <input type="hidden" name="existing_user_name" value="<?php echo $result['user_name'];  ?>"  />
     	
</table>
     
     <br />
     <br />
     
     <table  class="std_detail_info_table">
     <caption>
     Contact Information
     </caption>
     	<tr>
        	<td class="std_detail_side_labels" style="border-radius:8px 0 0 0;">Cell no:</td>
            <td class="long_row" style="border-radius:0 8px 0px 0px;"><input type="text" name="cell_no" value="<?php echo $result['cell_no']; ?>" id="cell_no" onblur="return validate_cell_no();" onkeydown="return add_dashes_cell_no();" onkeyup="return validate_cell_char();"/></td>
        </tr>
     	<tr>
     	  <td class="std_detail_side_labels"> Address:</td>
     	  <td class="long_row"><input type="text" name="address" value="<?php echo $result['address'];  ?>" id="address"  onkeyup="return validate_address();"/></td>
   	    </tr>
     	<tr>
     	  <td class="std_detail_side_labels" style="border-radius:0px 0px 0px 8px;">Email:</td>
     	  <td class="long_row" style="border-radius:0 0 8px 0px;"> <input type="text" name="email" value="<?php echo  $result['email'];  ?>" id="email" onkeyup="return validate_email();" /></td>
   	  </tr>
     </table>
           <p align="center">&nbsp; </p>
           <input type="hidden" name="member_id" value="<?php echo $result['id'];    ?>" />
          <p align="center"> <input type="submit" name="upd_btn" value="update" class="action_btns" /><?php  ?></p>
    

 
   
  
     
      </form>
</div><!--end of main_content -->


</div><!--end of content -->
</div><!--end of container -->
<?php include_once("includes/footer.php");?>
</body>
</html>
<?php mysql_close($connection); ?>