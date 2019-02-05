<?php 
session_start();
	require_once("includes/connection.php");
	require_once("includes/functions.php");
	
	
	   if($_SESSION['logged'] !="true"){
	   
	   redirect_to("index.php?login=false");
   }
 
   if(isset($_GET['campus_department_selection'])&&($_GET['campus_department_selection']=="false")){
	   $campus_selection_message="You have to Select a Campus or department";
   }else{
	   $campus_selection_message=NULL;
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
<script>
   
</script>
</head>
<body>
<div id="container">
<?php include_once("includes/header.php"); ?>
<div id="content">



<div id="main_content">
	<h1>All Campuses Summary</h1>
    <div id="error_p" ><?php
	   echo $campus_selection_message;
		 ?> </div>
             
    <?php

   $all_campuses=get_all_campuses_id();
   if(mysql_num_rows($all_campuses)==0){
     echo "<p id=\"no_campus\"> Campus Record not exist</p>";
   }
else{
   
   while($each_campus=mysql_fetch_array($all_campuses)){
	   
	   echo "<p class=\"campus_summary\">$each_campus[campus_name]</p>";
	   $campus_id=$each_campus['id'];
	   $all_departments=get_departments_by_campus_id($campus_id);
	   ?>
	     <table width="810" class="summary_table">
 
     	<tr id="labels">
        	<td width="189">Department </td>
             <td width="189">Male Students</td>
            <td width="194">Female Students</td>
            <td width="190">Total Students</td>
                
            <td width="24">&nbsp;</td>
        </tr>
        
 <?php

		
		while($each_department=mysql_fetch_array($all_departments)){
			$department_id=$each_department['id'];
			$department_name=$each_department['department_name'];
			$department_female_details=get_female_details_in_department($department_id,$campus_id);
			$department_male_details=get_male_details_in_department($department_id,$campus_id);
			$each_department_total_student=get_all_student_detail_in_department($department_id,$campus_id);
			?>
	      <tr class="department_rows">
		    <td> <?php echo $department_name ?></td>
		    <td><?php echo $department_male_details ?></td>
		    <td><?php echo $department_female_details ?></td>
		    <td><?php echo $each_department_total_student ?></td>
		    <td>&nbsp;</td>
		   </tr>
		
	    <?php 
		}
   ?>
   
   
   </table>
	<?php   
		
   }
}

?>

    
    
    
    
    
    
    
    
	
      
</div><!--end of main_content -->




</div><!--end of content -->
</div><!--end of container -->
<?php include_once("includes/footer.php");?>
</body>
</html>
<?php mysql_close($connection); ?>