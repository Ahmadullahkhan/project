<?php
	require_once("includes/connection.php");
	require_once("includes/functions.php");
session_start();
if($_SESSION['logged']!="true"){
 redirect_to("index.php?login=false");
}



if(isset($_GET['dept_update'])&& ($_GET['dept_update']=="true")){
      $department_update_message="Department Name Updated";
	  
 }else{
     $department_update_message=NULL;
}

  if(isset($_GET['campus_update'])&&($_GET['campus_update']=="true")){
	  $campus_update_message="Campus Name Updated";
  }else{
	  $campus_update_message=NULL;
  }
  if(isset($_GET['department_delete'] )&& ($_GET['department_delete']=="yes")){
	  $department_delete_message="Department Deleted";
  }else{
	  $department_delete_message=NULL;
  }

  if(isset($_GET['campus_added']) &&($_GET['campus_added']=="true")){
	  $campus_added_message="Campus Added Successfuly";
	  
  }else{
	  $campus_added_message=NULL;
  }
  if(isset($_GET['department_added'])&&($_GET['department_added']=="true")){
	  $department_added_message="Department Added ";
  }else{
     $department_added_message=NULL;
  }
  
  if(isset($_GET['department_added_msg'])&&($_GET['department_added']=="false")){
	  $department_added_unsucsess="Department Not Added ";
  }else{
     $department_added_unsucsess=NULL;
  }
  
  if(isset($_GET['campus_exist'])&& ($_GET['campus_exist']
=="true")){
	$campus_exist_message="This campus already Exist";
}else{
	$campus_exist_message=NULL;
}
	  
  
  if(isset($_GET['record_exist']) &&($_GET['record_exist']=="yes")){
	  $department_record_message="This department contain Records";
  }else{
	  $department_record_message=NULL;
  }
 if(isset($_GET['department_exist']) && ($_GET['department_exist'])=="true"){
	 $dept_exist_message="This Department Already Exist";
 }else{
	 $dept_exist_message=NULL;
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
<script type="text/javascript" src="scripts/validate_campus_selected.js"></script>
<script>

function add_new_campus(){
      add_campus="<table style=\"margin-top:12px\" class=\"table_add_new_campus\">";
	  add_campus+="<tr class=\"table_row\"><td class=\"text_label_new_campus\">Campus Name</td>";
      add_campus+="<td><input type=\"text\" name=\"new_campus\" id=\"campus_name\" onkeyup=\"return validate_campus_name();\" /></td></tr>";
	  add_campus+="<tr><td class=\"text_label_new_campus\">Department Name</td>";
      add_campus+="<td><input type=\"text\" name=\"new_department\" id=\"new_department\" onkeyup=\"return validate_new_department_name();\" /></td> </tr> </table>";
          
   	   
  
    

    add_campus+=" <p style=\"margin-left:140px\";><input type=\"submit\" name=\"add_new_campusbtn\" value=\" Add Campus\" class=\"add_campus_btn\" style=\"width: 120px\";/></p> ";
     
	document.getElementById("new_campus").innerHTML=add_campus;
	document.getElementById("campus_div").innerHTML="";
	document.getElementById("Edit_campus_name").innerHTML="";
	document.getElementById("add_new_dept").innerHTML="";
}

function edit_campus_department(){
   if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	
 			ajaxObj = new XMLHttpRequest();
		
 		}else{// code for IE6, IE5
	
 					ajaxObj = new ActiveXObject("Microsoft.XMLHTTP");
  			}
	           ajaxObj.onreadystatechange=function(){
					if ((ajaxObj.readyState==2) && ajaxObj.status==200){
						//document.getElementById("department").innerText="Please Wait";
					} 
					
					if (ajaxObj.readyState==4 && ajaxObj.status==200){
						
						       
						
						document.getElementById("add_new_dept").innerText="";
					   document.getElementById("new_campus").innerHTML="";
						document.getElementById("Edit_campus_name").innerHTML="";
						document.getElementById("campus_div").innerHTML =ajaxObj.responseText;
					
					}
			}
				processURL = "ajax_process_get_campus_and_department.php";
			ajaxObj.open("GET",processURL,true);
			ajaxObj.send(null);
}

function edit_campus_name(){
	  if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	
 			ajaxObj = new XMLHttpRequest();
		
 		}else{// code for IE6, IE5
	
 					ajaxObj = new ActiveXObject("Microsoft.XMLHTTP");
  			}
			
		 ajaxObj.onreadystatechange=function(){
					if ((ajaxObj.readyState==2) && ajaxObj.status==200){
						//document.getElementById("department").innerText="Please Wait";
					} 
					
					if (ajaxObj.readyState==4 && ajaxObj.status==200){
						
						       
						
					document.getElementById("add_new_dept").innerText="";
					    document.getElementById("new_campus").innerHTML="";
					document.getElementById("campus_div").innerHTML="";
						
						document.getElementById("Edit_campus_name").innerHTML =ajaxObj.responseText;
					
					}
			}
				processURL = "ajax_process_get_campus.php";
			ajaxObj.open("GET",processURL,true);
			ajaxObj.send(null);
}
	
function add_new_department_in_campus(){
	
	  if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	
 			ajaxObj = new XMLHttpRequest();
		
 		}else{// code for IE6, IE5
	
 					ajaxObj = new ActiveXObject("Microsoft.XMLHTTP");
  			}
			
		 ajaxObj.onreadystatechange=function(){
					if ((ajaxObj.readyState==2) && ajaxObj.status==200){
						//document.getElementById("department").innerText="Please Wait";
					} 
					
					if (ajaxObj.readyState==4 && ajaxObj.status==200){
						
						       
						
						document.getElementById("Edit_campus_name").innerText="";
					    document.getElementById("new_campus").innerHTML="";
					    document.getElementById("campus_div").innerHTML="";
						
						document.getElementById("add_new_dept").innerHTML =ajaxObj.responseText;
					
					}
			}
				processURL = "ajax_process_get_campus_department.php";
			ajaxObj.open("GET",processURL,true);
			ajaxObj.send(null);

}

function  get_department(){
	
	campus_id=document.getElementById("campus").value;
	
	  if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	
 			ajaxObj = new XMLHttpRequest();
		
 		}else{// code for IE6, IE5
	
 					ajaxObj = new ActiveXObject("Microsoft.XMLHTTP");
  			}
			
		 ajaxObj.onreadystatechange=function(){
					if ((ajaxObj.readyState==2) && ajaxObj.status==200){
						//document.getElementById("department").innerText="Please Wait";
					} 
					
					if (ajaxObj.readyState==4 && ajaxObj.status==200){
						
						       
						
					
						
						document.getElementById("get_department").innerHTML =ajaxObj.responseText;
					
					}
			}
				processURL = "ajax_process_get_department_in_campus.php?campus_id="+campus_id;
			ajaxObj.open("GET",processURL,true);
			ajaxObj.send(null);

	
}
	

   
</script>
</head>
<body>
<div id="container">
<?php include_once("includes/header.php"); ?>
<div id="content">





<div id="main_content">

	<h1>Add Campus</h1>
    <div id="left_col_content">
 
      <input type="button" name="btn"  class="btn_style1"  onclick="return edit_campus_department();" value="Edit Department" />
          <input type="button" name="Edit_campusBtn" value="Edit Campus"  class="btn_style1"  onclick="return edit_campus_name();" />
      
    
        <input type="button" name="add_new_campus" value="Add New campus" class="btn_style1" onclick="return add_new_campus();"  />
          
        <input type="button" name="add_new_department" value="Add Department" class="btn_style1"  onclick="return add_new_department_in_campus();" />      


</div> <!--end of left col -->
     <div id="error_p" ><?php  echo $department_record_message; echo $campus_added_message;
         echo $department_added_message;
	     echo  $department_added_unsucsess;
	     echo $campus_exist_message;
		 echo  $dept_exist_message;
		 echo $department_update_message;
		 echo $campus_update_message;
		 echo $department_delete_message;
		 ?> </div>
   
   <?php 
  
   
   
   	 $campus=get_total_campuses();
	 
	 if($campus==FALSE){
		 
		 echo "Campus Not Exist";
	 }else{
	 
	 
     while($each_campus=mysql_fetch_array($campus)){

	 $campus_id=$each_campus['id'];
	 
 
	  $campus_name=$each_campus['campus_name'];
	   
	  $department=get_department($campus_id);
	
   
   
	
       echo " <table class=\"campus_table\">";
       echo "<caption class=\"caption_center\">$campus_name</caption>";
   
       while($each_department=mysql_fetch_array($department)){
		  
	   $html="<tr class=\"department_rows\">";
       $html.="<td class=\"left_caption\">$each_department[department_name]</td><td id=\"delete_btn\">";
	   $html.="<a href=\"delete_department.php?id=$each_department[id]&campus_id=$campus_id\">Delete</td></tr>";
			
       echo $html;
		   
	  }
	
	   echo "<input type=\"hidden\" name=\"campus_id\" value=\"$campus_id\">";
       echo "  </table>";
	 

	 
      }
   }
     
   ?>
   
   <!--Button for Edit campus & Edit department -->
   
       
     
     
     
    <!--Button for Add new Campus & Department --> 
     
     
      <div id="button_div">
      
         
         
         
         
         
<!--form for Edit department -->

      <div class="edit_department">
        <form name="edit_department" method="get" action="edit_department_name.php" onsubmit="return validate_edit()">
           <span id="campus_div">
         
       </form>
      </div>

       
<!--form for Edit campus_name -->

   <div class="edit_department">
          <form name="edit_campus" method="get" action="edit_campus_name.php" onsubmit="return validate_campus_select();" >
             <span id="Edit_campus_name">
             
             </span>
           
           
           </form>
   </div>
<!--form for add new Campus -->
      <div class="edit_department">
    <form name="add_campus_form" method="post" action="process_add_campus.php" onsubmit="return validat_campus_dept_name();">
      <span id="new_campus">
     
       </span>
     </form>
     </div>
<!-- form for add new  Department-->
     <div class="edit_department">
    <form name="add_new_department" method="post" action="process_add_new_department.php" onsubmit="return validate_add_new_dept();" >
      <span id="add_new_dept">
      
      </span>
    </form>   
    </div>    
       
    
        
	 
  
   
   
  </div><!--end of button div --> 
      
</div><!--end of main_content -->







</div><!--end of content -->
</div><!--end of container -->


<?php include_once("includes/footer.php");?>
</body>
</html>
<?php mysql_close($connection); ?>