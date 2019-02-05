<?php 
	require_once("includes/connection.php");
	require_once("includes/functions.php");
	
	$all_records = get_all_students_records();

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
   function confirm_delete(){
		  var del = confirm("Are you sure to delete this record?");
		  
		  return del;	  
   }
</script>
</head>
<body>
<div id="container">
<?php include_once("includes/header.php"); ?>
<div id="content">


<div id="main_content">
 	 <h1>View Records</h1>
     <table class="rec_view_table">
     <caption>Students Information</caption>
     	<tr id="labels">
        	<td width="54">Sno</td>
            <td width="88">Form no.</td>
            <td width="81">Roll no.</td>
            <td width="168">Student Name.</td>
            <td width="125">Father Name.</td>
            <td width="128">Department</td>
            <td width="144">Campus</td>
            <td width="5">&nbsp;</td>
        </tr>
        
        
        <?php
			if($all_records != FALSE){
				$sno = 1;
				while($each_record = mysql_fetch_array($all_records)){
					if($sno % 2 == 1){
						$class = "class=\"rec_row_odd\"";
					}else{
						$class = "class=\"rec_row_even\"";
					}
					$html = "<tr $class>
								<td>$sno</td>
								<td>{$each_record['form_no']}</td>
								<td>{$each_record['roll_no']}</td>
								<td class=\"table_anchor\"><a href=\"view_student_details.php?id={$each_record['id']}\">{$each_record['name']}</a></td>
								<td>{$each_record['father_name']}</td>
								<td>{$each_record['department']}</td>
								<td>{$each_record['campus']}</td>
								<td><a href=\"delete_student_record.php?id={$each_record['id']}\" onclick=\"return confirm_delete();\" >X</a>
									<a href=\"update_student_record.php?id={$each_record['id']}\">U</a>
								</td>
							</tr>";
					echo $html;
					$sno++;
				}
			}
		?>
        
        
        
        
     </table>

      
</div><!--end of main_content -->


</div><!--end of content -->
</div><!--end of container -->
<?php include_once("includes/footer.php");?>
</body>
</html>
<?php mysql_close($connection); ?>