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
	<h1>heading</h1>
	
      
</div><!--end of main_content -->
<?php
 $campus=$_GET['campus'];
 $department=$_GET['department'];
 
  $result=get_student_information_in_department($campus,$department);
      if($result !=FALSE){
		  echo "    <table class=\"rec_view_table\">
     <caption>Students Information</caption>
     	<tr id=\"labels\">
        	<td width=\"54\">Sno</td>
            <td width=\"88\">Form no.</td>
            <td width=\"81\">Roll no.</td>
            <td width=\"168\">Student Name.</td>
            <td width=\"125\">Father Name.</td>
            <td width=\"128\">Department</td>
            <td width=\"144\">Campus</td>
            <td width=\"5\">&nbsp;</td>
        </tr>";
        
    
			if($result != FALSE){
				$sno = 1;
				while($each_record = mysql_fetch_array($result)){
					if($sno % 2 == 1){
						$class = "class=\"rec_row_odd\"";
					}else{
						$class = "class=\"rec_row_even\"";
					}
					$html = "<tr $class>
								<td>$sno</td>
								<td>{$each_record['form_no']}</td>
								<td>{$each_record['roll_no']}</td>
								<td><a href=\"view_student_details.php?id={$each_record['id']}\">{$each_record['name']}</a></td>
								<td>{$each_record['father_name']}</td>
								<td>{$each_record['department']}</td>
								<td>{$each_record['campus']}</td>
								<td><a href=\"delete_student_record.php?id={$each_record['id']}\">X</a>
									<a href=\"update_student_record.php?id={$each_record['id']}\">U</a>
								</td>
							</tr>";
					echo $html;
					$sno++;
				}
			}
		?>
        
        
        
        
     </table>
		  
	<?php	  
	  }else{
		  echo "no detail in this department";
	  }




?>




</div><!--end of content -->
</div><!--end of container -->
<?php include_once("includes/footer.php");?>
</body>
</html>
<?php mysql_close($connection); ?>