<?php
  session_start();
	require_once("includes/connection.php");
	require_once("includes/functions.php");
	if($_SESSION['logged']!="true"){
 redirect_to("index.php?login=false");
}
 
  
  if(isset($_GET['department_exist'])&&($_GET['department_exist']=="true")){
  $department_exist_message="This Department Already Exist";
  }else{
	  $department_exist_message=NULL;
	  
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
<script type="text/javascript" src="scripts/validate_dept_name.js"></script>
<script>
   
</script>
</head>
<body>
<div id="container">
<?php include_once("includes/header.php"); ?>
<div id="content">


<div id="main_content">
	<h1>Edit Departments Name</h1>
    
    
     <div id="error_p" ><?php  echo $department_exist_message;
		 ?> </div> 
 <form name="edit_campus_name" method="post" action= "process_edit_department_name.php" onsubmit="return validate_department(<?php echo $_GET['department'];  ?>);" >
    <?php 
     
	    $campus_id=$_GET['campus'];
	  $department_id=$_GET['department'];
	   
	   $campus=get_campus_by_id($campus_id);
	   $departments=get_department_by_id($campus_id);
	   $campus_name=mysql_fetch_array($campus);
	   echo " <table class=\"campus_table\">";
	   echo "<caption class=\"caption_center\">$campus_name[campus_name]</caption>";
	   $counter=0;
	   
		   while($each_department=mysql_fetch_array($departments)){
		     	 if($each_department['id']==$department_id){
					
				 
			
	 $html="<tr class=\"department_rows\">";
     $html.="<td><input type=\"text\" name=department_name value=\"$each_department[department_name]\"  ";
	 $html.=" onkeyup=\"return validate_department_name($each_department[id]);\" id=\"$each_department[id]\"  onblur=\"return validate_department_name($each_department[id]);\" /></td></tr>";
	  $html.="<input type=\"hidden\" name=\"department_id\" value=\"$each_department[id]\" />";
	  $html.="<input type=\"hidden\" name=\"campus_id\" value=\"$campus_id\"/>";
				 }else{
			 $html="<tr class=\"department_rows\">";
			 $html.="<td>$each_department[department_name]</td></tr>";
					 
				 }
		       
        echo $html;
		   
		   }
		   
	   
	  
	
	?>
     
      
	</table>
    <input type="submit" name="submitbtn" value="update" id="campus_name_updatebtn" class="btn_style1" />
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