<?php 
   session_start();
	require_once("includes/connection.php");
	require_once("includes/functions.php");
	
	

if($_SESSION['logged']!="true"){
 redirect_to("index.php?login=false");
}

     
	 if(isset($_GET['confirm'])&& $_GET['confirm'] =="true")
	   {
		 
         $confirm= ok_msg("record inserted successfully");
	   }else
	   { 
		$confirm=NULL;
	   }
	   if(isset($_GET['student_exist']) && $_GET['student_exist'] =="false"){
		   $student_exist="This student record already exist";
	   }else{
          $student_exist=NULL;
	   }
	   if(isset($_GET['genral_information']) && $_GET['genral_information']=="false"){
           $genral_information="genral information insertion failed";	   
 	   }else{
		   $genral_information= NULL;
	   }
	   
	   if(isset($_GET['academic_record']) && $_GET['academic_record'] =="false"){
	    $academic_record="academic record_insertion failed";
	   }else{
		   $academic_record= NULL;
	   }
	   if(isset($_GET['account_record']) && $_GET['account_record'] == "false"){
	   $account_record="account record insertion failed";
	   } else{
	   $account_record= NULL;
	   }
	   if(isset($_GET['record_insert'] ) && $_GET['record_insert'] == "true"){
		   $record_insertion="registration success";
	   }else{
		   $record_insertion=NULL;
	   }
	   if(isset($_GET['query_failed']) && $_GET['query_failed'] =="true"){
		   $query_failed="database query failed ";
	   }else{
		   $query_failed=NULL;
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
<script type="text/javascript" src="scripts/my_script.js">
</script>

<script type="application/javascript" src="scripts/jquery/jquery-1.8.3.js"></script>
<script type="text/javascript" src="scripts/jquery/jquery-ui.js"></script>
<script>
//Tip for Jquery syntex to understand
//     $();
	
	
	$(function(){
		//Script for Date Picker.......
			$("#date").datepicker({
				dateFormat:'yy-mm-dd',
			    gotoCurrent: true,
			    showAnim: 'fold',
				
				changeMonth: true,
				changeYear: true,
				
			});
			$("#student_dob").datepicker({
				
				dateFormat:'yy-mm-dd',
			    gotoCurrent: true,
			    showAnim: 'fold',
				changeMonth: true,
				changeYear: true,
			})
			
			$("#receipt_date").datepicker({
				dateFormat:'yy-mm-dd',
			    gotoCurrent: true,
			    showAnim: 'fold',
				changeMonth: true,
				changeYear: true,
			});
			
		//Script for Add Button.
			$("#add_btn").button();
		
		//Script for Dialog Box
		 	$("#msgBox").dialog({
				title: "Error",
				autoOpen:false,
				width:300,
				height:300,
				modal: true,
				show: "blind",
				hide: "explode",
				buttons: {
							OK: function(){
								$(this).dialog("close");	
							}
				}
				
			});
		//Script for Titles
			$( document ).tooltip({
				position: {
                my: "center bottom-20",
                at: "center top",
                using: function( position, feedback ) {
                    $( this ).css( position );
                    $( "<div>" )
                        .addClass( "arrow" )
                        .addClass( feedback.vertical )
                        .addClass( feedback.horizontal )
                        .appendTo( this );
               	 }
           		}	
			});
			
		//Dialog for error..............
		$("#error_marks_details").dialog({
					autoOpen:false,
					title:"Error",
					show: "blind",
					hide: "explode",
					buttons:{
								OK: function(){
									$(this).dialog("close");	
								}
					}
		});
		
		
	});//End of jquery Object
	
//My Javascript Coding.......
	function add_new_marks_details(){
		var academic_validation=validate_academic_record();
		
		if(academic_validation==true){
		var acadamic_type = document.getElementById("acadamic_record").value;
		var total =   document.getElementById("marks_total").value;
		var obt   =   document.getElementById("marks_obt").value;
		var board =   document.getElementById("board").value;
		
		
		
		if(document.getElementById("check_acadamic_type").value != acadamic_type){
			
			if(document.getElementById("acadamic_record").value==""){
				$("#error_marks_details").dialog("open");
			}else{
				data_to_append ="<tr class=\"form_table_marks\"><td>"+acadamic_type +"</td><td>"+obt+"</td><td>"+total+"</td><td>"+board;
			data_to_append += " <input type=\"hidden\" name="+acadamic_type+"_total value="+total+" />";
			data_to_append += "<input type=\"hidden\" name="+acadamic_type+"_obt value="+obt+" />";
			data_to_append += "<input type=\"hidden\" name="+acadamic_type+"_board value="+board+" /></td>";
			data_to_append += "<td>&nbsp;</td></tr>";
			$("#my_table").append(data_to_append);
			document.getElementById("check_acadamic_type").value = acadamic_type;
			document.getElementById("marks_obt").value = "";
			document.getElementById("marks_total").value = "";
			document.getElementById("board").value = "";
			document.getElementById("marks_obt").focus();
			}
			
	document.getElementById("acadamic_record").remove(document.getElementById("acadamic_record").selectedIndex);
		}else{
			$("#error_marks_details").dialog("open");
			
		}

		}
	}
	
	
	 function get_department(){
		 
		
	  
			
			
			   var campus_id=document.getElementById("student_campus").value;
			   
			   var department="$id="+campus_id;
	   document.getElementById("dept_id").innerHTML=campus_id;
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
						document.getElementById("department").innerText="Please Wait";
					} 
					
					if (ajaxObj.readyState==4 && ajaxObj.status==200){
						
						document.getElementById("department").innerText="";
						document.getElementById("department").innerHTML =ajaxObj.responseText;
					
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
	<h1>Add Student Record</h1>
     <form name="std_form" method="post" action="process_add_student_record.php" enctype="multipart/form-data" onsubmit="return validate_student_addmission_form();" class="form_with_labels" >
    <table width="674" class="form_table">
    	<tr>
        	<td width="160" class="form_label">Form No:</td>
            <td width="216"><input name="form_no" type="text" class="form_text_boxes" id="form_no"  onkeyup="validate_form_no();" maxlength="5" /></td>
            <td width="282"><span id="form_no_notify" class="span_notify" > </span></td>
        </tr>
        <tr>
        	<td class="form_label">Date:</td>
        	<td><input name="date" type="text" class="form_text_boxes" id="date"   onkeyup="validate_date();" value="<?php echo date("y-m-d"); ?>" /></td>
            
           <td width="282"><span id="date_notify" class="span_notify" > </span></td>
  
            
        </tr>
        <tr>
        	<td class="form_label">Amount:</td>
        	<td><input name="amount" type="text" class="form_text_boxes" id="amount"  onkeyup="validate_amount();" maxlength="6" /></td>
         <td width="282"><span id="amount_notify" class="span_notify" > </span></td>
        </tr>
        <tr>
          <td class="form_label">Reciept No:</td>
          <td><input name="receipt_no" type="text" class="form_text_boxes" id="receipt_no" onkeyup="validate_receipt_no();" maxlength="8" /></td>
           <td width="282"><span id="receipt_no_notify" class="span_notify" > </span></td>
        </tr>
        <tr>
        	<td class="form_label">Reciept Date:</td>
        	<td><input name="reciept_date" type="text" class="form_text_boxes" id="receipt_date"  value="2013-03-07" onblur="validate_receipt_date();" /></td>
            <td><span id="receipt_date_notify" class="span_notify" > </span></td>
        </tr>
        
          <tr>
        	<td class="form_label">Image:</td>
        	<td><input name="my_file"  type="file" class="form_text_boxes" id="receipt_date"  /></td>
            <td><span id="receipt_date_notify" class="span_notify" > </span></td>
        </tr>
        
        
        <tr>
          <td class="form_label">Roll No:</td>
          <td><input name="roll_no" type="text" class="form_text_boxes" id="roll_no"  onkeyup="validate_roll_no();" maxlength="5"/></td>
         <td width="282"><span id="roll_no_notify" class="span_notify" > </span></td>
        </tr>
        <tr>
          <td class="form_label">Student Name:</td>
          <td><input name="name" type="text" class="form_text_boxes" id="name" onkeyup="validate_name();" maxlength="35"/></td>
          <td width="282"><span id="name_notify" class="span_notify" > </span></td>
        </tr>
        <tr>
          <td class="form_label">Student CNIC:</td>
          <td><input name="cnic" type="text" class="form_text_boxes" id="cnic" onkeyup="validate_cnic_char();" onblur="return validate_cnic();"  onkeydown="add_dashes_to_std_nic_no();"/></td>
          <td><span id="cnic_notify" class="span_notify" > </span> </td>
        </tr>
        
        <tr>
          <td class="form_label">Father Name:</td>
          <td><input name="father_name" type="text" class="form_text_boxes"  id="father_name" onkeyup="validate_father_name();" maxlength="35"/></td>
          <td width="282"><span id="father_name_notify" class="span_notify" > </span></td>
        </tr>
        
         <tr>
          <td class="form_label">Father CNIC:</td>
          <td><input name="father_cnic" type="text" class="form_text_boxes"  id="father_cnic" onkeyup="return validate_father_cnic_char();" onblur="validate_father_cnic();" onkeydown=" add_dashes_to_nic_no();"/></td>
          <td><span id="father_cnic_notify" class="span_notify" > </span> </td>
        </tr>
        
          <tr>
          <td class="form_label">Student DOB:</td>
          <td><input name="date_of_birth" type="text" class="form_text_boxes"  id="student_dob" onblur="validate_student_dob();" readonly="readonly" value="1990-17-04" /></td>
          <td><span id="student_dob_notify" class="span_notify" > </span> </td>
        </tr>
        
        <tr>
          <td class="form_label">Gender:</td>
          <td><select name="gender" class="form_text_boxes"  id="student_gender" onblur="validate_student_gender();">
            <option value="0" selected="selected">Gender</option>
            <option value="M">Male</option>
            <option value="F">Female</option>
          </select></td>
          <td><span id="student_gender_notify" class="span_notify" > </span></td>
        </tr>
        <tr>
         
        </tr>
        
        <tr>
          <td class="form_label">Semester:</td>
          <td><select name="semester" class="form_text_boxes" id="student_semester"  >
           
            <option value="1" selected="selected">1st </option>
           
          </select></td>
          <td><span id="student_semester_notify" class="span_notify" > </span></td>
        </tr>
        
       <tr>
          <td class="form_label">study program:</td>
          <td><select name="study_program" class="form_text_boxes" id="student_study_programe"  onblur="validate_student_study_programe();">
            <option value="0" selected="selected">select Program </option>
            <option value="Bs Hons">Bs Hons</option>
            <option value="MSc">MSC</option>
            <option value="MA">MA</option>
            <option value="Mcs">MSC</option>
            <option value="Ms">MS</option>
            <option value="M.ED">M.ED</option>
            <option value="B.ED">B.ED</option>
            <option value="M.Phil">M.Phil</option>
            <option value="Phd">PHD</option>
           
          
           
          </select></td>
          <td><span id="student_study_programe_notify" class="span_notify" > </span></td>
        </tr>
        <tr>
         <td class="form_label">Campus:</td>
          <td><select name="campus" class="form_text_boxes" id="student_campus"  onblur="validate_student_campus();" onChange="get_department_in_campus();">
            <option value="0">select campus</option>
            <?php $campus=get_all_campus();
			 while($result=mysql_fetch_array($campus)){
		     echo "<option value=\"$result[id]\">$result[campus_name]</option>";
			 }
			?>
        
          </select></td>
          <td> <span id="student_campus_notify" class="span_notify" > </span></td>
            
            </tr>
      
        
        
        
        
        <tr>
          <td class="form_label">Department:</td>
          <td><select name="department" class="form_text_boxes" id="department" >
          <option value="0" selected="selected">Department</option>
          
        
           </select></td>
          <td><span id="student_department_notify" class="span_notify" > </span></td>
         
         
         
         
         
        </tr>
        <tr>
          <td class="form_label">Domicile:</td>
          <td><select name="domicile" class="form_text_boxes"  id="domicile" onblur="validate_domicile();" onchange="validate_domicile();"/>
           <option value="0" selected="selected"> Domicile</option>
            <option value="Abbottabad">Abbottabad</option>
            <option value="Bannu">Bannu</option>
            <option value="Battagram">Battagram</option>
            <option value="Buner">Buner</option>
            <option value="Charsadda">Charsadda</option>
            <option value="Chitral">Chitral</option>
            <option value="Dera Ismail Khan">Dera Ismail Khan</option>
            <option value="Haripur">Haripur</option>
            <option value="hangu">Hangu</option>
            <option value="Karak">Karak</option>
            <option value="Kohat">Kohat</option>
            <option value="Kohistan">Kohistan</option>
            <option value="Lakki Marwat">Lakki Marwat</option>
            <option value="Lower Dir">Lower Dir</option>
            <option value="Malakand">Malakand</option>
            <option value="Mansehra">Mansehra</option>
            <option value="Mardan" >Mardan</option>
            <option value="Nowshera">Nowshera</option>
            <option value="Peshawar">Peshawar</option>
            <option value="Shangla">Shangla</option>
            <option value="Swabi">Swabi</option>
            <option value="Swat">Swat</option>
            <option value="Tank">Tank</option>
            <option value="Tor Ghar">Tor Ghar</option>
            <option value="Upper Dir">Upper Dir</option>
          </select>
          
          </td>
          <td width="282"><span id="domicile_notify" class="span_notify" > </span></td>
        </tr>
        <tr>
          <td class="form_label">Nationality:</td>
     <td><select name="nationality" class="form_text_boxes" id="nationality" onblur="validate_nationality();" onchange="validate_nationality();" />
          <option value="0">Nationality</option>
          <option value="Pakistani">Pakistani</option>
          <option value="Afghani">Afghani</option>
          <option value="Other">Other</option>
          </select>
     
     </td>
        <td width="282"><span id="nationality_notify" class="span_notify" > </span></td>
        </tr>
        <tr>
          <td class="form_label">Religion:</td>
          <td><select name="religion"  class="form_text_boxes" id="religion" onblur="validate_religion();" onchange="validate_religion();"/>
          <option value="0">Relegion</option>
          <option value="Islam">Islam</option>
          <option value="Christian">Christian</option>
          <option value="Ahmadi">Ahmadi</option>
          <option value="Sikh">Sikh</option>
          </select>
          </td>
          <td width="282"><span id="religion_notify" class="span_notify" > </span></td>
        </tr>
        <tr>
          <td class="form_label">District:</td>
          <td><select name="district" class="form_text_boxes" id="student_district" onchange="validate_student_district();" onblur="validate_student_district();">
            <option value="0" selected="selected"> District</option>
            <option value="Abbottabad">Abbottabad</option>
            <option value="Bannu">Bannu</option>
            <option value="Battagram">Battagram</option>
            <option value="Buner">Buner</option>
            <option value="Charsadda">Charsadda</option>
            <option value="Chitral">Chitral</option>
            <option value="Dera Ismail Khan">Dera Ismail Khan</option>
            <option value="Haripur">Haripur</option>
            <option value="hangu">Hangu</option>
            <option value="Karak">Karak</option>
            <option value="Kohat">Kohat</option>
            <option value="Kohistan">Kohistan</option>
            <option value="Lakki Marwat">Lakki Marwat</option>
            <option value="Lower Dir">Lower Dir</option>
            <option value="Malakand">Malakand</option>
            <option value="Mansehra">Mansehra</option>
            <option value="Mardan" >Mardan</option>
            <option value="Nowshera">Nowshera</option>
            <option value="Peshawar">Peshawar</option>
            <option value="Shangla">Shangla</option>
            <option value="Swabi">Swabi</option>
            <option value="Swat">Swat</option>
            <option value="Tank">Tank</option>
            <option value="Tor Ghar">Tor Ghar</option>
            <option value="Upper Dir">Upper Dir</option>
          </select></td>
          <td><span id="student_district_notify" class="span_notify" > </span></td>
        </tr>
        <tr>
          <td class="form_label">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td class="form_label">Present  Address:</td>
          <td><input name="present_address" type="text" class="form_text_boxes" id="address_postal"  onkeyup="validate_present_address();" maxlength="60"/></td>
         <td width="282"><span id="present_address_notify" class="span_notify" > </span></td>
        </tr>
        <tr>
          <td class="form_label">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td class="form_label">Permanent Address:</td>
          <td><input name="permanent_address" type="text" class="form_text_boxes" id="permanent_address" onkeyup="validate_student_permanent_address();"  /></td>
          <td><span id="permanent_address_notify" class="span_notify" > </span> </td>
        </tr>
        <tr>
          <td class="form_label">Cell No:</td>
          <td><input name="cell" type="text" class="form_text_boxes"  id="cell" onblur="validate_student_cell_no(); " onkeydown="add_dashes_cell_no();" onkeyup="return validate_cell_digits();"/></td>
          <td><span id="cell_notify" class="span_notify" > </span></td>
        </tr>
           <tr>
          <td class="form_label">Email:</td>
          <td><input name="email" type="text" class="form_text_boxes"  id="student_email" onblur="validate_email_address();"/></td>
          <td> <span id="email_notify" class="span_notify" > </span></td>
        </tr>
        
        <tr>
          <td class="form_label">Migrate Semester:</td>
          <td><input name="migrate_semester" type="radio" value="y" id="migrate_semester" />
            Yes
  <input type="radio" name="migrate_semester" value="n" id="migrate_semester"  /> No</td>
          <td><span id="migrate_semester_notify" class="span_notify" > </span> </td>
        </tr>
        <tr>
          <td class="form_label">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td class="form_label">Remarks:</td>
          <td><textarea name="remarks" class="form_text_areas"  id="remarks" onkeyup="validate_remarks();">Student won laptop</textarea></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td class="form_label">&nbsp;</td>
          <td><input type="hidden" name="check_acadamic_type" id="check_acadamic_type" value="" /></td>
          <td>&nbsp;</td>
        </tr>
               
    </table> <!--end of table 1 -->
    
    <br />
  <table>
    <tr>
     <td width="204">&nbsp; </td>
     <td width="152"><span id="marks_obtain_notify" class="span_notify" > </span> </td>
     <td width="152"><span id="marks_total_notify" class="span_notify" > </span> </td>
     <td width="160"><span id="board_notify" class="span_notify" > </span> </td>
     <td width="160">&nbsp;   </td>
   </tr>
 </table>
    
    <table width="772" class="form_table" id="my_table" style="margin-left:0px;">
    	<tr class="form_table_labels">
        	<td width="208">Level of Education</td>
            <td width="152">Obtained Marks</td>
            <td width="152">Total Marks</td>
            <td width="152">Board/Institute</td>
            <td width="84">&nbsp;</td>
       
    	<tr class="form_table_labels">
    	  <td><select name="acadamic_record2" class="form_text_boxes" id="acadamic_record">
    	    <option value="SSC" selected="selected">SSC</option>
    	    <option value="HSSC">HSSC</option>
    	    <option value="BA_BSC">BA/BSc</option>
    	    <option value="MA/MSc">MA/MSc</option>
    	    <option value="Others">Others</option>
  	    </select></td>
    	  <td><input type="text" name="marks_obt" id="marks_obt" onkeyup="return validate_student_marks_obtain();" onblur="return validate_marks_obtain(); " /></td>
    	  <td><input type="text" name="marks_total" id="marks_total" onkeyup="return validate_student_marks_total();" onblur="return validate_marks_total();" /></td>
    	  <td><input type="text" name="board" id="board" onkeyup="return validate_student_board();" onblur="return validate_board();" /></td>
    	  <td><input name="add_marks_btn" type="button" onclick="add_new_marks_details();"  value="Add Details" id="add_marks_btn" /></td>
  	  </tr>
    </table>
    <p><input name="add_btn" type="submit" class="action_btns" value="Save Record" style="background-color:#7C0E1F !important ;color:#FFF; margin-left: 279px;" /><?php echo $student_exist , $genral_information, $academic_record,$account_record,$record_insertion;   ?></p>
    </form>
    <div id="msgBox">
    	<p>Sorry, Please try again.</p>
    </div><!--end of msgBox -->
    
</div><!--end of main_content -->


</div><!--end of content -->
</div><!--end of container -->
<?php include_once("includes/footer.php");?>
</body>
</html>
<?php mysql_close($connection); ?>