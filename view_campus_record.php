<?php
   session_start();
   require_once("includes/connection.php");
	require_once("includes/functions.php");
   
    if($_SESSION['logged'] !="true"){
	   
	   redirect_to("index.php?login=false");
   }
   if(!isset($_GET['campus_id'])){
	   redirect_to("view_all_campuses_record.php?campus_department_selection=false");
	   
   }
   if(isset($_GET['checkbox']) && ($_GET['checkbox']=="false")){
	   $chckbox_checked_message="You have to SELECT at least on checkbox to delete a record";
   }else{
	   $chckbox_checked_message==NULL;
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
	
		
	
		
		if(isset($_GET['campus_id']) && ($_GET['department_id'])){
			
		$campus_id=$_GET['campus_id'];	
	    $department_id= $_GET['department_id'];
		$student_campus_id=$campus_id;
		$student_department_id=$department_id;
	   
	  
		$total_pages=count_all_records_campus_department($campus_id,$department_id,$per_page);
		$all_records=get_department_in_campus($campus_id,$department_id,$current_loaded_page,$per_page);
     

		}else{
		$campus_id=$_GET['campus_id'];
		$student_campus_id=$campus_id;

	
	   
	       $total_pages=get_total_pages($campus_id,$per_page);
	 
			$all_records=get_campus_record($campus_id,$current_loaded_page,$per_page);
		
			
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
      <div id="error_p" ><?php 
	  echo $chckbox_checked_message; 
	  
	  
		 ?> </div>
         
         <?php
		 if(mysql_num_rows($all_records)==0){
					echo  "Record not Exist";
				} else{
			
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
        
        
      <form name="all_student_record" method="post" action="process_delete_all_student_record.php" onsubmit="return check_box_selected();">  
        
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
							
							
							
							
							$html.="<td><a href=\"delete_student_record.php?id={$each_record['id']}&campus_id=";
							$html.="{$each_record['campus']}&department_id={$each_record['department']}&page_no=$current_loaded_page\" onclick=\"return confirm_delete();   \">";
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
		 if(isset($_GET['campus_id'])&&($_GET['department_id'])){
			  $back="<p><a href=\"view_campus_record.php?";
	          $back.="page_no={$previous_page}&campus_id=$student_campus_id&";
	          $back.="department_id=$student_department_id \">Back ";
		 }else{
		 $back="<p><a href=\"view_campus_record.php?";
		 $back.="page_no={$previous_page}&campus_id=$student_campus_id\">Back ";
	     }
	}
	
	 
	 if($current_loaded_page==$total_pages){
		$next=NULL;
	 }else{
		  if(isset($_GET['campus_id'])&&($_GET['department_id'])){
		 $next="<p><a href=\"view_campus_record.php?";
		 $next.="page_no={$next_page}&campus_id=$student_campus_id&department_id=$student_department_id\">Next</a> </p>";
		  }else{
		 
		 $next="<p><a href=\"view_campus_record.php?";
		 $next.="page_no={$next_page}&campus_id=$student_campus_id\">Next</a> </p>";
	 }
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
			 if(isset($campus_id)&&($department_id)){
			echo "<a href=\"view_campus_record.php?page_no={$counter}&campus_id=$student_campus_id&department_id=$student_department_id\"> $counter </a> ";
			 }else{
				 
	echo "<a href=\"view_campus_record.php?page_no={$counter}&campus_id=$student_campus_id\"> $counter </a> ";
			 }
	 }
	 }
	 echo $next;
	
	 ?>
     <p> <input type="hidden" name="student_campus_id" value="<?php echo $student_campus_id; ?>"/>
        <input type="hidden" name="page_no" value="<?php echo $current_loaded_page;   ?>" />
     
<p class="add_btn_container"><input type="submit" name="delte_btn" value="Delete Marked"  class="action_btns" onclick="return confirm_delete();"/></p>
 </form>
 
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