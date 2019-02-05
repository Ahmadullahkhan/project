<?php 
session_start();
	require_once("includes/connection.php");
	require_once("includes/functions.php");
	if($_SESSION['logged']!="true"){
 redirect_to("index.php?login=false");
}



 $id=$_GET['id'];


$member_record=get_site_member_information_by_id($id);

 $each_member=mysql_fetch_array($member_record);

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
   
</script>
</head>
<body>
<div id="container">
<?php include_once("includes/header.php"); ?>
<div id="content">



<div id="main_content">
	<h1>heading</h1>
	  <div id="error_p" ><?php  
		     
			  ?> </div>
              
              
                <table class="std_detail_info_table">
     <caption>Member General Information<span class="right_caption"> 
     </caption>
     	<tr>
        	<td class="std_detail_side_labels" style="border-radius:8px 0 0 0;">Name:</td>
            <td class="std_detail_values"><?php echo $each_member['name'];  ?></td>
            <td class="std_detail_side_labels">Father Name:</td>
            <td class="std_detail_values" style="border-radius:0 8px 0px 0px;"><?php echo $each_member['father_name']; ?></td>
        </tr>
     	<tr>
     	  <td class="std_detail_side_labels">Gender:</td>
     	  <td class="std_detail_values"><?php if($each_member['gender']=="M") {echo "Male";} else {echo "Female";}  ?></td>
     	  <td class="std_detail_side_labels">CNIC:</td>
     	  <td class="std_detail_values"><?php echo $each_member['nic']; ?></td>
   	  </tr>
     	<tr>
     	  <td class="std_detail_side_labels" style="border-radius:0 0 0 8px">User Name:</td>
     	  <td class="std_detail_values"><?php echo $each_member['user_name']; ?></td>
     	  <td class="std_detail_side_labels">Date of Birth</td>
     	  <td class="std_detail_values" style="border-radius: 0 0 8px 0px"><?php echo $each_member['dob']; ?></td>
   	  </tr>
     	
 
    
      </table>
      
        <br />
     
     <table  class="std_detail_info_table">
     <caption>
     Contact Information
     </caption>
     	<tr>
        	<td class="std_detail_side_labels" style="border-radius:8px 0 0 0;">Cell no:</td>
            <td class="long_row" style="border-radius:0 8px 0px 0px;"><?php echo $each_member['cell_no']; ?></td>
        </tr>
     	<tr>
     	  <td class="std_detail_side_labels"> Address:</td>
     	  <td class="long_row"><?php echo $each_member['address'];  ?></td>
   	    </tr>
     	<tr>
     	  <td class="std_detail_side_labels" style="border-radius:0px 0px 0px 8px;">Email:</td>
     	  <td class="long_row" style="border-radius:0 0 8px 0px;"><?php echo  $each_member['email'];  ?></td>
   	  </tr>
     </table>
     
      
</div><!--end of main_content -->
<?php


?>




</div><!--end of content -->
</div><!--end of container -->
<?php include_once("includes/footer.php");?>
</body>
</html>
<?php mysql_close($connection); ?>