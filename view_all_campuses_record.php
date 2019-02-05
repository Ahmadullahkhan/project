<?php 
session_start();
	require_once("includes/connection.php");
	require_once("includes/functions.php");
	 if($_SESSION['logged'] !="true"){
	   
	   redirect_to("index.php?login=false");
   }
   
   if(isset($_GET['id_selection'])&&($_GET['id_selection']=="false")){
   $student_selection_message="Student name must be clicked to view student details";
   
   }else{
	   $student_selection_message=NULL;
   }
	   
   
   if(isset($_GET['campus_department_selection'])&&($_GET['campus_department_selection']=="false")){
	   $campus_selection_message="You have to Select a Campus or department";
   }else{
	   $campus_selection_message=NULL;
   }
   
 
   $per_page=10;
	if(!empty($_GET['page_no'])){
			$current_loaded_page=$_GET['page_no'];
			$next_page=$current_loaded_page+1;
			$previous_page=$current_loaded_page-1;
			
		}else{
			$current_loaded_page=1;
			$next_page=$current_loaded_page +1;
			$previous_page=$current_loaded_page-1;
		}
	
		
	   $total_pages=get_total_pages_of_all_campuses($per_page);
   

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
	<h1>All Campus Record</h1>
	 <div id="error_p" ><?php
	   echo $campus_selection_message;
	   echo $student_selection_message;		 ?> </div>
         
  <?php
  $all_records=get_all_records($current_loaded_page,$per_page);
  
  
  ?>  
  
    
     <table width="829" class="rec_view_table">
     <caption>Students Information</caption>
     	<tr id="labels">
        	<td width="18" class="sno_td">sno</td>
       
            <td width="49" class="roll_no_class">Roll no.</td>
            <td width="164" style="padding-left:14px">Student Name.</td>
            <td width="143">Father Name.</td>
            <td width="112">Department</td>
            <td width="110">Campus</td>
            <td width="109">Image</td>
            <td width="77">&nbsp; </td>
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
								<td class=\"sno_td\"><input type=checkbox name=delete_box[] value=$each_record[id] /></td>
								
								<td class=\"roll_no_class\">{$each_record['roll_no']}</td>
								<td class=\"table_anchor\"><a href=\"view_student_details.php?id={$each_record['id']}\">{$each_record['name']}</a></td>
								<td>{$each_record['father_name']}</td>";
								$std_department_id=$each_record['department'];
								
								// 
								$student_department=get_student_department($std_department_id); 
								
							$html.="<td>{$student_department['department_name']}</td>";
							 $std_campus=$each_record['campus'];
							 $student_campus=get_student_campus($std_campus);
							
							$html.="<td>{$student_campus['campus_name']}</td>";
							
							$html.="<td><img src=uploads/".$each_record['id'].".jpg width=30px height=25px> </td>";
							
							
							
							
							$html.="<td><a href=\"delete_student_record_all_campus.php?id={$each_record['id']}";
							$html.="&page_no=$current_loaded_page\" onclick=\"return confirm_delete();   \">";
							$html.="<img src=\"images/delete.jpg\" width=\"30px\" height=\"25px\" / ></a>";
							$html.="<a href=\"update_student_record.php?id={$each_record['id']}\">";
							$html.="<img src=\"images/index.jpg\" width=\"30px\" height=\"25px\" / ></a></td></tr>";
							
							
					echo $html;
					$sno++;
				}
			}
			
		
		?>
   </table> 
   
     <?php   
	
	 if($current_loaded_page==1){
		 $back=NULL;
	 }else{
		
		 $back="<p><a href=\"view_all_campuses_record.php?";
		 $back.="page_no={$previous_page}\">Back ";
	     	}
	
	 
	 if($current_loaded_page==$total_pages){
		$next=NULL;
	 }else{
		  
		 
		 $next="<p><a href=\"view_all_campuses_record.php?";
		 $next.="page_no={$next_page}\">Next</a> </p>";
	 
	 }
	 if($total_pages==0){
		 $next=NULL;
	     $back=NULL;
	 }
	 
	 echo $back ;


	 for($counter=1;$counter<=$total_pages;$counter++){
		 if($current_loaded_page==$counter){
			 echo  $counter;
		 }else{
				 
	echo "<a href=\"view_campus_record.php?page_no={$counter}\"> $counter </a> ";
			 
	 }
	 }
	 echo $next;
	
	 ?>            
      
</div><!--end of main_content -->
</div><!--end of content -->
</div><!--end of container -->
<?php include_once("includes/footer.php");?>
</body>
</html>
<?php mysql_close($connection); ?>