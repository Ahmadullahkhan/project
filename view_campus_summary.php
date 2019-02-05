<?php
session_start();
	require_once("includes/connection.php");
	require_once("includes/functions.php");
	
	
	   if($_SESSION['logged'] !="true"){
	   
	   redirect_to("index.php?login=false");
   }
   if(!isset($_GET['campus_id'])){
	   redirect_to("view_all_campuses_summary.php?campus_department_selection=false");
	   
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

	<h1>Campus Summary</h1>
<?php
if(isset($_GET['campus_id'])&&($_GET['department_id'])){
 $campus_id=$_GET['campus_id'];
 $department_id=$_GET['department_id'];
 
 $campus_name=get_campus_name_by_id($campus_id);
?>


     <?php echo "<p class=\"campus_summary\">$campus_name[campus_name]</p>"; ?>
    <table width="810" class="summary_table">
 
     	<tr id="labels">
              <td width="189" >Department </td>
              <td width="189">Male Students</td>
              <td width="194">Female Students</td>
              <td width="190">Total Students</td>
                
            <td width="24">&nbsp;</td>
        </tr>
        
            <?php
	$all_campus_details=get_campus_summary_by_id($campus_id);
		$department=get_department($campus_id);
		$each_department=mysql_fetch_array($department);
			$department_id=$each_department['id'];
			$department_name=$each_department['department_name'];
			$department_female_details=get_female_details_in_department($department_id,$campus_id);
			$department_male_details=get_male_details_in_department($department_id,$campus_id);
			$each_department_total_student=get_all_student_detail_in_department($department_id,$campus_id);
	    echo "<tr class=\"department_rows\">";
		echo   "<td class=\"department_labels\">$department_name</td>";
		echo  "<td>$department_male_details</td>";
		echo "<td>$department_female_details</td>";
		echo "<td>$each_department_total_student</td>";
		echo   "<td>&nbsp;</td>";
		echo "</tr>";
		
	     ?>
   
   
   </table>
   
<?php
}else{
	$campus_id=$_GET['campus_id'];
	

$campus_name=get_campus_name_by_id($campus_id);
?>


     <?php echo "<p class=\"campus_summary\">$campus_name[campus_name]</p>"; ?>
    <table width="810" class="summary_table">
 
     	<tr id="labels">
        	<td width="189">Department </td>
             <td width="189">Male Students</td>
            <td width="194">Female Students</td>
            <td width="190">Total Students</td>
                
            <td width="24">&nbsp;</td>
        </tr>
        
            <?php
	$all_campus_details=get_campus_summary_by_id($campus_id);
		$department=get_department($campus_id);
		while($each_department=mysql_fetch_array($department)){
			$department_id=$each_department['id'];
			$department_name=$each_department['department_name'];
			$department_female_details=get_female_details_in_department($department_id,$campus_id);
			$department_male_details=get_male_details_in_department($department_id,$campus_id);
			$each_department_total_student=get_all_student_detail_in_department($department_id,$campus_id);
	    echo "<tr class=\"department_rows\">";
		echo   "<td>$department_name</td>";
		echo  "<td>$department_male_details</td>";
		echo "<td>$department_female_details</td>";
		echo "<td>$each_department_total_student</td>";
		echo   "<td>&nbsp;</td>";
		echo "</tr>";
		}
	     ?>
   
   
   </table>
   
<?php
}

?>
	
      
</div><!--end of main_content -->





</div><!--end of content -->
</div><!--end of container -->
<?php include_once("includes/footer.php");?>
</body>
</html>
<?php mysql_close($connection); ?>