<?php 
	require_once("includes/connection.php");
	require_once("includes/functions.php");
	
	if(isset($_GET['no_change'])&& ($_GET['no_change']=="true")){
	$no_change_message="you make no Change in campus name";
	
	
	}else{
	$no_change_message=NULL;
	}
	if(isset($_GET['campus_exist'])&& ($_GET['campus_exist']=="true")){
		$campus_exist_message="This campus Already Exist";
		
	}else{
		$campus_exist_message=NULL;
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
<script type="application/javascript" src="scripts/jquery/jquery-1.8.3.js"></script>
<script type="text/javascript" src="scripts/jquery/jquery-ui.js"></script>
<script type="text/javascript"  src="scripts/validate_campus_name.js"></script>
<script>
   
</script>
</head>
<body>
<div id="container">
<?php include_once("includes/header.php"); ?>
<div id="content">



<div id="main_content">
	<h1>Edit Campus Name</h1>
    
    
     <div id="error_p" ><?php echo $no_change_message; echo $campus_exist_message;
		 ?> </div>
    
	<form name="edit_campus_name" method="post" action="process_edit_campus_name.php" onsubmit="return validate_campus_name_text();">
    <?php 
	   $campus_id=$_GET['campus'];
	   
	   $campus=get_campus_by_id($campus_id);
	  
	   $departments=get_department_by_id($campus_id);
	    $campus_name=mysql_fetch_array($campus);
		 echo " <table class=\"campus_table\">";
		 echo "<input type=\"hidden\" name=\"old_name\" value=\"$campus_name[campus_name]\">";
		
		  echo "<caption class=\"caption_center\"><input type=\"text\" name=\"campus_name\" value=\"$campus_name[campus_name]\" id=\"campus_name\" onkeyup=\"return validate_campus_name_text();\"></caption>";
		  echo "<input type=\"hidden\" name=\"campus_id\" value=\"$campus_name[id]\">";
		   while($each_department=mysql_fetch_array($departments)){
	
			  
			    $html="<tr class=\"department_rows\">
            <td>$each_department[department_name]</td></tr>";
		 
        echo $html;
		   
		   }
		   
	
	?>
  
	
      </table>
      <p>  <input type="submit" name="submit" value="Update" id="update_btn" class="btn_style1"></p>
      </form>
</div><!--end of main_content -->
<?php


?>




</div><!--end of content -->
</div><!--end of container -->
<?php include_once("includes/footer.php");?>
</body>
</html>
<?php mysql_close($connection); ?>