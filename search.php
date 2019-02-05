<?php 
session_start();
	require_once("includes/connection.php");
	require_once("includes/functions.php");
	 if($_SESSION['logged'] !="true"){
	   
	   redirect_to("index.php?login=false");
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
<script type="text/javascript" src="scripts/my_script.js">

</script>
<script type="text/javascript" src="scripts/search_form_validate_scripts.js"></script>
<script>

function check_search_by(){
	var search_by =document.getElementById("search_by").value;
	document.getElementById("label").innerHTML=search_by;
}

function get_department_in_campus(){

	
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	
 			ajaxObj = new XMLHttpRequest();
		
 		}else{// code for IE6, IE5
	
 					ajaxObj = new ActiveXObject("Microsoft.XMLHTTP");
  			}
	
	
	var category_id = document.getElementById("student_campus").value;	
	
			ajaxObj.onreadystatechange=function(){
					if ((ajaxObj.readyState==2) && ajaxObj.status==200){
						document.getElementById("student_department").innerText="Please Wait";
					} 
					
					if (ajaxObj.readyState==4 && ajaxObj.status==200){
						
						document.getElementById("student_department").innerText="";
						document.getElementById("student_department").innerHTML =ajaxObj.responseText;
					
					}
			}
					
						
					
			processURL = "ajax_process_get_department.php?category_id="+category_id;
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
	<h1> Search</h1>
    
       <div id="error_p" ><?php  
	  
	  
		 ?> </div>
     <div id="search_box">
    <form name="search_form" id="search_form" method="post" action="process_search.php" onsubmit="return validate_search_form();">
     <table id="search_table"> 
         <tr>
             <td class="form_table_labels round">Search By:</td>
             <td> <select name="search_by" id="search_by" onchange="return check_search_by();" onblur="return check_search_by_select();" >
                 <option value="0" selected="selected"> search by</option>
                 <option value="Name">Name</option>
                 <option value="Phone">Phone</option>
                 <option value="CNIC">CNIC</option>
                 <option value="Domicile">Domicile</option>
                 <option value="Nationality">Nationality</option>
                </select></td>
          </tr>
          <tr>
          <td class="form_table_labels" id="label"> </td>
           <td ><input type="text" name="search" id="search" onkeyup="return validate_search_content();" style="width:196px;" /></td>
                
                </tr>
                <tr>
                <td class="form_table_labels">Campus:</td>
                <td> <select name="campus" class="form_text_boxes" id="student_campus" title="select Campus"  onchange="return get_department_in_campus();">
                <option value="0" selected="selected">campus</option>
             <?php $campus=get_all_campus();
			 while($result=mysql_fetch_array($campus)){
		     echo "<option value=\"$result[id]\">$result[campus_name]</option>";
			 }
			 ?>
          </select></td>
          
          </tr>
          <tr>
          <td class="form_table_labels">Department:</td>
          <td> <select name="department" class="form_text_boxes" id="student_department" title="select Department" onblur="validate_student_department();">
          <option value="0" selected="selected">Department</option>
          
          </select>  </td>
          </tr>
          
           <td class="form_table_labels round_bottom1">Search Type:</td>
           <td>
            <input type="checkbox" name="search_type" value="force_search" />Force Search
                    </td> 
           <tr>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
          </tr>
           <tr>
             <td>&nbsp;</td>
             <td ><input type="submit" name="searchbtn" value="Search" class="action_btns"/></td>
           </tr>          
          </table>
            </form>
    </div><!--end of search_box -->
    
    
</div><!--end of main_content -->
</div><!--end of content -->
</div><!--end of container -->
<?php include_once("includes/footer.php");?>
</body>
</html>
<?php mysql_close($connection); ?>