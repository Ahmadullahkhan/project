<?php 
session_start();
	require_once("includes/connection.php");
	require_once("includes/functions.php");
	
	 if($_SESSION['logged'] !="true"){
	   
	   redirect_to("index.php?login=false");
   }
	 $per_page=10;
	 if(empty($_GET['page_no'])){
		 $current_loaded_page=1;
		 $next_page=$current_loaded_page+1;
		 $previous_page=$current_loaded_page-1;
	 }else{
		 $current_loaded_page=$_GET['page_no'];
		  $next_page=$current_loaded_page+1;
		 $previous_page=$current_loaded_page-1;
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

<h1> Search Result</h1>
    
       <div id="error_p" ><?php  
	  
	  
		 ?> </div>

   
     
<?php 


 
if(isset($_POST['searchbtn'])){
	$search_by=$_POST['search_by'];
	$_SESSION['search_by']=$search_by;
    $search=$_POST['search'];
	$_SESSION['search']=$search;
    $campus=$_POST['campus'];
	$_SESSION['campus']=$campus;
	$department=$_POST['department'];
	$_SESSION['department']=$department;
	if(isset($_POST['search_type']))
	{
	
	$search_type=$_POST['search_type'];
	}else{
			$search_type="loose_search";

	}
	$_SESSION['search_type']=$search_type;
	
}
	if($_SESSION['search_type']=="force_search"){
		
		// force search when department and campus both are not selectd
		if(($_SESSION['campus']=="0")&& ($_SESSION['department']=="0") && ($_SESSION['search_by']=="Name")){
		 $total_pages=get_total_pages_by_name($_SESSION['search'],$per_page);
		 $result=force_search_by_name($_SESSION['search'],$current_loaded_page,$per_page); 	
		}else if(($_SESSION['campus']=="0")&& ($_SESSION['department']=="0") && ($_SESSION['search_by']=="Phone")){
			 $total_pages=get_total_pages_by_phone($_SESSION['search'],$per_page);
			$result=force_search_by_phone($_SESSION['search'],$current_loaded_page,$per_page);
		} else if(($_SESSION['campus']=="0")&& ($_SESSION['department']=="0") && ($_SESSION['search_by']=="CNIC")){
			$total_pages=get_total_pages_by_cnic($_SESSION['search'],$per_page);
			$result=force_search_by_cnic($_SESSION['search'],$current_loaded_page,$per_page);  // pagenation ok .
		} else if(($_SESSION['campus']=="0")&& ($_SESSION['department']=="0") && ($_SESSION['search_by']=="Domicile")){
			 $total_pages=get_total_pages_by_domicile($_SESSION['search'],$per_page);
		$result=force_search_by_domicile($_SESSION['search'],$current_loaded_page,$per_page);
		}else if(($_SESSION['campus']=="0") &&($_SESSION['department']=="0")&&($_SESSION['search_by']=="Nationality")){
			$total_pages=get_total_pages_by_nationality($_SESSION['search'],$per_page);
			$result=force_search_by_nationality($_SESSION['search'],$current_loaded_page,$per_page);
		
		
		// force search when only campus is selected (not department).
	
		} else if (($_SESSION['campus']!="0")&& ($_SESSION['department']=="0") && ($_SESSION['search_by']=="Name")){
			$total_pages=get_total_pages_by_name_by_campus($_SESSION['search'],$_SESSION['campus'],$per_page);
			$result=force_search_by_campus_by_name($_SESSION['campus'],$_SESSION['search'],$current_loaded_page,$per_page);
		} else if (($_SESSION['campus']!="0")&& ($_SESSION['department']=="0") && ($_SESSION['search_by']=="Phone")){
			$total_pages=get_total_pages_by_phone_by_campus($_SESSION['search'],$_SESSION['campus'],$per_page);
			$result=force_search_by_campus_by_phone($_SESSION['campus'],$_SESSION['search'],$current_loaded_page,$per_page);
		}else if (($_SESSION['campus']!="0")&& ($_SESSION['department']=="0") && ($_SESSION['search_by']=="CNIC")){
			$total_pages=get_total_pages_by_cnic_by_campus($_SESSION['search'],$_SESSION['campus'],$per_page);
			$result=force_search_by_campus_by_cnic($campus,$search,$current_loaded_page,$per_page);
		} else if (($_SESSION['campus']!="0")&& ($_SESSION['department']=="0") && ($_SESSION['search_by']=="Domicile")){
			$total_pages=get_total_pages_by_domicile_by_campus($_SESSION['search'],$_SESSION['campus'],$per_page);
			$result=force_search_by_campus_by_domicile($_SESSION['campus'],$_SESSION['search'],$current_loaded_page,$per_page);
		}else if(($_SESSION['campus']!="0") &&($_SESSION['department']=="0")&&($_SESSION['search_by']=="Nationality")){
			$total_pages=get_total_pages_by_nationality_by_campus($_SESSION['search'],$_SESSION['campus'],$per_page);
			$result=force_search_by_campus_by_nationality($_SESSION['campus'],$_SESSION['search'],$current_loaded_page,$per_page);		
			
		
		// force search when only  department is selected (not campus )
		}else if (($_SESSION['campus']=="0")&& ($_SESSION['department']!="0") && ($_SESSION['search_by']=="Name")){
			
			$total_pages=get_total_pages_by_name_and_department($_SESSION['search'],$_SESSION['department'],$per_page);
            $result=force_search_by_department_by_name($_SESSION['search'],$_SESSION['department'],$current_loaded_page,$per_page);
  		    }else if (($_SESSION['campus']=="0")&& ($_SESSION['department']!="0") && ($_SESSION['search_by']=="Phone")){
			$total_pages=get_total_pages_by_phone_and_department($_SESSION['search'],$_SESSION['department'],$per_page);
            $result=force_search_by_department_by_phone($_SESSION['search'],$_SESSION['department'],$current_loaded_page,$per_page);
  		    }else if (($_SESSION['campus']=="0")&& ($_SESSION['department']!="0") && ($_SESSION['search_by']=="CNIC")){
			$total_pages=get_total_pages_by_cnic_and_department($_SESSION['search'],$_SESSION['department'],$per_page);
			 $result=force_search_by_department_by_cnic($_SESSION['search'],$_SESSION['department'],$current_loaded_page,$per_page);
	       } else if (($_SESSION['campus']=="0")&& ($_SESSION['department']!="0") && ($_SESSION['search_by']=="Domicile")){
			   
			   $total_pages=get_total_pages_by_domicile_and_department($_SESSION['search'],$_SESSION['department'],$per_page);
            $result=force_search_by_department_by_domicile($_SESSION['search'],$_SESSION['department'],$current_loaded_page,$per_page);
  		    } else if(($_SESSION['campus']=="0")&&($_SESSION['department'] !="0") &&($_SESSION['search_by']=="Nationality")){
				 $total_pages=get_total_pages_by_nationality_and_department($_SESSION['search'],$_SESSION['department'],$per_page);
			  $result=force_search_by_department_by_nationality($_SESSION['search'],$_SESSION['department'],$current_loaded_page,$per_page);	
				
			
		// force search when both Department and campus are selected .
	
			}else if (($_SESSION['campus'] !="0") && ($_SESSION['department']!="0") &&($_SESSION['search_by']=="Name")){
		  $total_pages=get_total_pages_by_dept_campus_by_name($_SESSION['search'],$_SESSION['department'],$_SESSION['campus'],$per_page);
		   $result=force_search_by_dept_campus_by_name($_SESSION['search'],$_SESSION['department'],$_SESSION['campus'],$current_loaded_page,$per_page);
		} else if (($_SESSION['campus'] !="0") && ($_SESSION['department']!="0") &&($_SESSION['search_by']=="Phone")){
			 $total_pages=get_total_pages_by_dept_campus_by_phone($_SESSION['search'],$_SESSION['department'],$_SESSION['campus'],$per_page);
			 $result=force_search_by_dept_campus_by_phone($_SESSION['department'],$_SESSION['campus'],$_SESSION['search'],$current_loaded_page,$per_page);
		} else if (($_SESSION['campus'] !="0") && ($_SESSION['department']!="0") &&($_SESSION['search_by']=="CNIC")){
			
			 $total_pages=get_total_pages_by_dept_campus_by_cnic($_SESSION['search'],$_SESSION['department'],$_SESSION['campus'],$per_page);
			$result=force_search_by_dept_campus_by_cnic($_SESSION['department'],$_SESSION['campus'],$_SESSION['search'],$current_loaded_page,$per_page);
		}
		else if (($_SESSION['campus'] !="0") && ($department!="0") &&($search_by=="Domicile")){
			$result=force_search_by_dept_campus_by_domicile($department,$campus,$search);
	    }
		else if (($_SESSION['campus'] !="0") && ($_SESSION['department']!="0") &&($_SESSION['search_by']=="Nationality")){
			 $total_pages=get_total_pages_by_dept_campus_by_nationality($_SESSION['search'],$_SESSION['department'],$_SESSION['campus'],$per_page);
			$result=force_search_by_dept_campus_by_nationality($_SESSION['department'],$_SESSION['campus'],$_SESSION['search'],$current_loaded_page,$per_page);
	    }
		
// loose search  when both (campus and department) are not selected.
	 }else{
		 if(($_SESSION['campus']=="0")&& ($_SESSION['department']=="0") && ($_SESSION['search_by']=="Name")){
		  $total_pages=get_total_pages_loose_search_by_name($_SESSION['search'],$per_page);
			
		    $result=loose_search_by_name($search,$current_loaded_page,$per_page);
		 }else if(($_SESSION['campus']=="0")&& ($_SESSION['department']=="0") && ($_SESSION['search_by']=="Phone")){
			 $total_pages=get_total_pages_lose_search_by_phone($_SESSION['search'],$per_page);
			$result=loose_search_by_phone($_SESSION['search'],$current_loaded_page,$per_page);
		} else if(($_SESSION['campus']=="0")&& ($_SESSION['department']=="0") && ($_SESSION['search_by']=="CNIC")){
	      $total_pages=get_total_pages_loose_search_by_cnic($_SESSION['search'],$per_page);
		
		  $result=loose_search_by_cnic($_SESSION['search'],$current_loaded_page,$per_page);
		} else if(($_SESSION['campus']=="0")&& ($_SESSION['department']=="0") && ($_SESSION['search_by']=="Domicile")){
			
			
	     $total_pages=get_total_pages_loose_search_by_domicile($_SESSION['search'],$per_page);
	 
		 $result=loose_search_by_domicile($_SESSION['search'],$current_loaded_page,$per_page);
		}  else if(($_SESSION['campus']=="0")&& ($_SESSION['department']=="0") && ($_SESSION['search_by']=="Nationality")){
			$total_pages=get_total_pages_loose_search_by_nationality($_SESSION['search'],$per_page);
			
		$result=loose_search_by_nationality($_SESSION['search'],$current_loaded_page,$per_page);
		}
 
 
 
 // loose search when campus is selected. 
		    else if (($_SESSION['campus']!="0")&& ($_SESSION['department']=="0") && ($_SESSION['search_by']=="Name")){
				$total_pages=get_total_pages_loose_search_by_campus_and_name($_SESSION['campus'],$_SESSION['search'],$per_page);
				
			$result=loose_search_by_campus_by_name($_SESSION['campus'],$_SESSION['search'],$current_loaded_page,$per_page);
		    } else if (($campus!="0")&& ($department=="0") && ($search_by=="Phone")){
			$result=loose_search_by_campus_by_phone($campus,$search);
		    }else if (($campus!="0")&& ($department=="0") && ($search_by=="CNIC")){
			$result=loose_search_by_campus_by_cnic($campus,$search);
		    } else if (($campus!="0")&& ($department=="0") && ($search_by=="Domicile")){
			$result=loose_search_by_campus_by_domicile($campus,$search);
			}  else if (($campus!="0")&& ($department=="0") && ($search_by=="Nationality")){
			$result=loose_search_by_campus_by_nationality($campus,$search);
			}
		
// loose search when department is selected
		    else if (($campus=="0")&& ($department !="0") && ($search_by=="Name")){
			$result=loose_search_by_department_by_name($department,$search);
		    } else if (($campus=="0")&& ($department!="0") && ($search_by=="Phone")){
			$result=loose_search_by_department_by_phone($department,$search);
		    }else if (($campus=="0")&& ($department !="0") && ($search_by=="CNIC")){
			$result=loose_search_by_department_by_cnic($department,$search);
		    } else if (($campus=="0")&& ($department !="0") && ($search_by=="Domicile")){
			$result=loose_search_by_department_by_domicile($department,$search);
		    }  else if (($campus=="0")&& ($department !="0") && ($search_by=="Nationality")){
			$result=loose_search_by_department_by_nationality($department,$search);
		    }
			
// LOOSE SEARCH WHEN BOTH (DEPARTMENT & CAMPUS) IS SELECTED.
           else if (($_SESSION['campus'] !="0") && ($_SESSION['department']!="0") &&($_SESSION['search_by']=="Name")){
			   $total_pages=get_total_pages_by_campus_and_department_and_name($_SESSION['campus'],$_SESSION['department'],$_SESSION['search'],$current_loaded_page,$per_page);
			$result=loose_search_by_dept_campus_by_name($_SESSION['department'],$_SESSION['campus'],$_SESSION['search'],$current_loaded_page,$per_page);
		} else if (($_SESSION['campus'] !="0") && ($_SESSION['department']!="0") &&($_SESSION['search_by']=="Phone")){
			
			  $total_pages=get_total_pages_by_campus_and_department_and_phone($_SESSION['campus'],$_SESSION['department'],$_SESSION['search'],$per_page);
			$result=loose_search_by_dept_campus_by_phone($_SESSION['department'],$_SESSION['campus'],$_SESSION['search'],$current_loaded_page,$per_page);
		} else if (($_SESSION['campus'] !="0") && ($_SESSION['department']!="0") &&($_SESSION['search_by']=="CNIC")){
			 $total_pages=get_total_pages_by_campus_and_department_and_cnic($_SESSION['campus'],$_SESSION['department'],$_SESSION['search'],$per_page);
			$result=loose_search_by_dept_campus_by_cnic($_SESSION['department'],$_SESSION['campus'],$_SESSION['search'],$current_loaded_page,$per_page);
		}
		else if (($_SESSION['campus'] !="0") && ($_SESSION['department']!="0") &&($_SESSION['search_by']=="Domicile")){
			 $total_pages=get_total_pages_by_campus_and_department_and_domicile($_SESSION['campus'],$_SESSION['department'],$_SESSION['search'],$per_page);
			$result=loose_search_by_dept_campus_by_domicile($_SESSION['department'],$_SESSION['campus'],$_SESSION['search'],$current_loaded_page,$per_page);
			
	    } else if (($_SESSION['campus']!="0") && ($_SESSION['department']!="0") &&($_SESSION['search_by']=="Nationality")){
			 $total_pages=get_total_pages_by_campus_and_department_and_nationality($_SESSION['campus'],$_SESSION['department'],$_SESSION['search'],$per_page);
			
			
			$result=loose_search_by_dept_campus_by_nationality($_SESSION['department'],$_SESSION['campus'],$_SESSION['search'],$current_loaded_page,$per_page);
	    }
           
	
	}// end of else body.
	
	
	if(mysql_num_rows($result)==0){
		echo "sorry no record found";
	}else{








?>




 	 <h1>Search Result</h1>
     <div id="error_p" ><?php  
	  
	    // Div to Display Error or Success Message;
		 ?> </div>
     <table class="rec_view_table">
     <caption>Students Information</caption>
     	<tr id="labels">
        	<td width="67">Sno</td>
           
            <td width="118">Roll no.</td>
            <td width="145">Student Name.</td>
            <td width="160">Father Name.</td>
            <td width="137">Campus</td>
             <td width="139">Department</td>
            <td width="22">&nbsp;</td>
        </tr>
        
        
        <?php
			if($result != FALSE){
				$sno = 1;
				while($each_record = mysql_fetch_array($result)){
					if($sno % 2 == 1){
						$class = "class=\"rec_row_odd\"";
					}else{
						$class = "class=\"rec_row_even\"";
					}
					$html = "<tr $class>";
					$html.="<td>$sno</td>";
					
							 $html.="<td>{$each_record['roll_no']}</td>
								<td class=\"table_anchor\"><a href=\"view_student_details.php?id={$each_record['id']}\">{$each_record['name']}</a></td>
								<td>{$each_record['father_name']}</td>";
								$std_campus=$each_record['campus'];
								 $student_campus=get_student_campus($std_campus);
					$html.="<td>{$student_campus['campus_name']}</td>";
							
						$std_department_id=$each_record['department'];
								
								// 
								$student_department=get_student_department($std_department_id); 
								
							$html.="<td>{$student_department['department_name']}</td>";
								
								
	         $html.="<td><a href=\"delete_student_search_record.php?id={$each_record['id']}&search_type=$search_type&search=$search&campus=$campus&department=$department&serch_by=$search_by\" onclick=\"return confirm_delete();\" ><img src=\"images/delete.jpg\" width=\"30px\" height=\"25px\" / ></a>
									<a href=\"update_student_record.php?id={$each_record['id']}&search_type=$search_type&search=$search&campus=$campus&department=$department&serch_by=$search_by \"><img src=\"images/index.jpg\" width=\"30px\" height=\"25px\" / ></a>
								</td>
							</tr>";
					echo $html;
					$sno++;
				}
			}
		?>
        
        
        
        
     </table>
     
   <?php
   if($current_loaded_page==$total_pages){
	   $next=NULL;
   }else{
	   $next="<a href=\"process_search.php?page_no=$next_page\">Next</a>";
   
  }
  if($current_loaded_page==1){
     $back=NULL;
  }else{
	  $back="<a href=\"process_search.php?page_no=$previous_page\" >Back</a>  ";
  }
   echo $back;
   for($count=1; $count<=$total_pages;$count++){
	   if($count==$current_loaded_page){
		   echo $count;
	   }else{
		   echo "<a href=\"process_search.php?page_no=$count\" >  $count </a>";
	   }
   } // end of for loop for pagination 
  echo $next;
 
 

	}// end of else statment Mysql_num_rows($result)==0)
   ?>

      
</div><!--end of main_content -->


</div><!--end of content -->
</div><!--end of container -->
<?php include_once("includes/footer.php");?>
</body>
</html>
<?php mysql_close($connection); ?>