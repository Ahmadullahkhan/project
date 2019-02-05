<?php
session_start();
 if($_SESSION['logged'] !="true"){
	   
	   redirect_to("index.php?login=false");
 }



  if(isset($_GET['campus_added']) &&($_GET['campus_added']=="true")){
	  $campus_added_message="Campus Added Successfuly";
	  
  }else{
	  $campus_added_message=NULL;
  }
  if(isset($_GET['department_exist'])&& ($_GET['department_exist']=="true")){
     $department_exist_message="This department Already Exist";
	 
  }else{
	  $department_exist_message=NULL;
  
  }
	require_once("includes/connection.php");
	require_once("includes/functions.php");
	
	

	

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
	<h1>Add Campus</h1>
   
   <?php 
   $campus=get_all_campus();
   while($each_campus=mysql_fetch_array($campus)){
	   $campus_id=$each_campus['id'];
	   $campus_name=$each_campus['campus_name'];
	   
	  $department=get_department($campus_id);
	
    
   
	
   echo " <table class=\"campus_table\">";
    echo "<caption class=\"caption_center\">$campus_name</caption>";
   
      while($each_department=mysql_fetch_array($department)){
		  
		  $html="<tr class=\"department_rows\">
            <td>$each_department[department_name]</td></tr>";
			
        echo $html;
		   
	  }
	echo  "<tr style=\"background-color:white;\"><td><span id=\"$campus_id\"></span></td><td><span id=\"department_textbox\"></span></td></tr>";
	
	echo "<input type=\"hidden\" name=\"campus_id\" value=\"$campus_id\">";
     echo "  </table>";
	 
	 
	 
	 }
	
	 
	 ?>
      
 
   
<!--form for add new department -->
   

   
      
       
       <div class="add_new_department_form">
         <form name="add_new_dept" method="post" action="process_add_new_department.php">
         <select name="campus">
         <option value="0"> Campus</option>
         <?php
		 
		 $campus=get_all_campus();
		    while ($each_campus=mysql_fetch_array($campus)){
				echo "<option value=\"$each_campus[id]\"> $each_campus[campus_name]</option>";
			}
			?>
          </select>
            <input type="text" name="department"  />
     
      <input type="submit" name="btn_campus" value="Add Department" id="add_department_btn" /></span>
     </form>
     
     </div><!--end of add_new_department_form div -->
     
     
     

      
</div><!--end of main_content -->

<?php
echo $department_exist_message;


?>





</div><!--end of content -->
</div><!--end of container -->
<?php include_once("includes/footer.php");?>
</body>
</html>
<?php mysql_close($connection); ?>