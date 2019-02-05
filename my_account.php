<?php 
  session_start();
	require_once("includes/connection.php");
	require_once("includes/functions.php");
	if(isset($_GET['change_password'])&& ($_GET['change_password']=="true")){
		$change_password_message="password Change successfully";
	}else{
	   $change_password_message=NULL;
	}
	
	$id=$_SESSION['member_id'];
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
<link href="stylesheets/form_style.css" rel="stylesheet" type="text/css" />
<link href="stylesheets/jquery-ui.css" rel="stylesheet" type="text/css" />
<script type="text/javascript"></script>
<script type="application/javascript" src="scripts/jquery/jquery-1.8.3.js"></script>
<script type="text/javascript" src="scripts/jquery/jquery-ui.js"></script>
<script>
   function confirm_del(){
		var del = confirm("Are you sure you want to delete this record?");
		return del;   
   }
</script>
</head>
<body>
<div id="container">
<?php include_once("includes/header.php"); ?>
<div id="content">



<div id="main_content">
 	 <h1> Welcome <?php echo $_SESSION['name']; ?></h1>
     
      <div id="error_p" ><?php 
	  echo  $change_password_message; 
		 ?> </div>
     
 		<br />
     
     <table class="std_detail_info_table">
     <caption>Member General Information<span class="right_caption"> 
     <a href="update_member_record.php?id=<?php echo $id; ?>">Update</a></span></caption>
     	<tr>
        	<td class="std_detail_side_labels" style="border-radius:8px 0 0 0;">Name:</td>
            <td class="std_detail_values"><?php echo $result['name'];  ?></td>
            <td class="std_detail_side_labels">Father Name:</td>
            <td class="std_detail_values" style="border-radius:0 8px 0px 0px;"><?php echo $result['father_name']; ?></td>
        </tr>
     	<tr>
     	  <td class="std_detail_side_labels">Gender:</td>
     	  <td class="std_detail_values"><?php if($result['gender']=="M") {echo "Male";} else {echo "Female";}  ?></td>
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
    
  <p id="change_password_p"><a href="<?php echo "change_member_password.php?id=$id "?>" >Change password  <?php  ?>  </a></p>
     
     
</div><!--end of main_content -->


</div><!--end of content -->
</div><!--end of container -->
<?php include_once("includes/footer.php");?>
</body>
</html>
<?php mysql_close($connection); ?>