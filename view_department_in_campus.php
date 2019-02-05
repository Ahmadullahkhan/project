<?php 
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
<div id="left_col">
<?php include_once("includes/left_col_content.php"); ?>
</div><!--end of left_col -->


<div id="main_content">
	<h1>Department</h1>
	
      
</div><!--end of main_content -->
<?php

	$html="<table class=\"campus_table\"> 
       <tr> 
        <td> S.No</td>
        <td> Department</td>
       </tr>";
  $campus=$_GET['campus'];
  $result=get_department_in_campus($campus);
  if($result !=FALSE){
	  echo $html;
	  $count=1;
	  while($get_department=mysql_fetch_array($result)){
		  
	   echo  "<tr>";
	   echo "<td>$count</td>";
	   echo "<td><a href=\"view_department_details.php?campus=$campus & department=$get_department[department] \">{$get_department['department']}</a></td>";
	   
	   echo "</tr>";
	   $count=$count+1;
	
	  } // end of while loop
	  
	  echo "</table>";
  }else{
	  echo "no departmen in this campus";
  }

?>




</div><!--end of content -->
</div><!--end of container -->
<?php include_once("includes/footer.php");?>
</body>
</html>
<?php mysql_close($connection); ?>