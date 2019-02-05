<?php 
session_start();
	require_once("includes/connection.php");
	require_once("includes/functions.php");
	  if($_SESSION['logged'] !="true"){
	   
	   redirect_to("index.php?login=false");
   }
	  if(isset($_GET['id'])){
	$student_id= $_GET['id'];
	$genral_record = get_student_genral_information_by_id($student_id);
	  if($genral_record !=FALSE){
		  
		 $account_record=get_student_account_information_by_id($student_id);
		  $count_account_record=get_student_account_record($student_id);
	
	    if($account_record !=FALSE){
		     $academic_record=get_student_academic_information_by_id($student_id);
			 if(($academic_record['ba_bsc_obtain_marks']==0)&&($academic_record['ma_msc_obtain_marks']==0)&&($academic_record['other_obtain_marks']==0)){
			  $count_row=1;
			
			 }else if (($academic_record['ma_msc_obtain_marks']==0)&&($academic_record['other_obtain_marks']==0)){
				 $count_row=2;
				 echo $count_row;
				 
				
			 }else if($academic_record['other_obtain_marks']==0){
			 $count_row=3;
			 }else{
			  $count_row=4;
			 }
	  }
	  }else{
		  redirect_to("update_student_record.php?upd_genral_record=false");
	  }
	  }else{
		  redirect_to("view_campus_record.php?campus_id=1");
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
<script type="text/javascript" src="scripts/update_student_my_script.js"></script>
<script type="application/javascript" src="scripts/jquery/jquery-1.8.3.js"></script>
<script type="text/javascript" src="scripts/jquery/jquery-ui.js"></script>
<script>




   $(function(){
		$("#upd_btn").button();
		$("#date").datepicker({
				changeMonth: true,
				changeYear: true,
				minDate: -0, 
				maxDate: "+2M +10D",
			}); 
			$("#student_dob").datepicker({
				
				dateFormat:'yy-mm-dd',
			    gotoCurrent: true,
			    showAnim: 'fold',
				changeMonth: true,
				changeYear: true,
			})
   });
   
   
   
   
   function get_department(){
	 

	
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
  
   
   
   function show_cal(box_id){
	  
	  
	   $(function(){
		   $("#"+box_id).datepicker({
			   dateFormat:'yy-mm-dd',
				changeMonth: true,
				changeYear: true,
			
			});
	   });
		    
   }
     
</script>
</head>
<body>
<div id="container">
<?php include_once("includes/header.php"); ?>
<div id="content">



<div id="main_content">
 	 <h1>Update Student Record</h1>
 	 <br />
     
       <div id="error_p" ><?php  
		 ?> </div>
     <form name="update_form" action="process_update_student_record.php" method="post" onsubmit="return validate_student_update_form(<?php echo $count_row;echo ","; echo $count_account_record;  ?>);">
     <table class="std_detail_info_table">
     <caption>Student General Information</caption>
     	<tr>
        	<td class="std_detail_side_labels" style="border-radius:8px 0 0 0;">Student Name:</td>
            <td class="std_detail_values"><input name="std_name" type="text" class="form_text_boxes" title="enter Student Name" value="<?php echo $genral_record['name']; ?>" onkeyup="return validate_name();" id="std_name" /></td>
            <td class="std_detail_side_labels">Father Name:</td>
            <td class="std_detail_values" style="border-radius:0 8px 0px 0px;"><input name="father_name" type="text" class="form_text_boxes" title="enter Father name" value="<?php echo $genral_record['father_name']; ?>" id="father_name" onkeyup="return validate_father_name();"/>              </td>
        </tr>
        
           	<tr>
        	<td class="std_detail_side_labels" style="border-radius:0px 0 0 0;">Student cnic:</td>
            <td class="std_detail_values"><input name="cnic" type="text" class="form_text_boxes" title="enter Student Name" value="<?php echo $genral_record['cnic']; ?>" id="cnic" onblur="return validate_cnic();" onkeydown="return add_dashes_to_student_nic_no();" onkeyup="return validate_nic_char();" /></td>
            <td class="std_detail_side_labels">Father Cnic:</td>
            <td class="std_detail_values" style="border-radius:0 0px 0px 0px;"><input name="father_cnic" type="text" class="form_text_boxes"  value="<?php echo $genral_record['father_cnic']; ?>" id="father_cnic" onblur="return validate_father_cnic();" onkeydown="return  add_dashes_to_father_nic_no();" onkeyup="return validate_fnic_char();"/>              </td>
        </tr>
        
     	<tr>
     	  <td class="std_detail_side_labels">Gender:</td>
     	  <td class="std_detail_values"><select name="gender" class="form_text_boxes" title="select gender" id="gender" onblur="return validate_student_gender();">
           <option value="0" >Gender</option>
     	    <option value="M" <?php if($genral_record['gender'] =="M"){echo "selected=\"selected\""; } ?>>Male</option>
     	    <option value="F" <?php if($genral_record['gender'] =="F"){echo "selected=\"selected\""; } ?>>Female</option>
   	    </select>     	 </td>
     	  <td class="std_detail_side_labels">Roll no:</td>
     	  <td class="std_detail_values"><input name="roll_no" type="text" class="form_text_boxes" id="roll_no"  value="<?php echo $genral_record['roll_no']; ?>" onkeyup="return validate_roll_no();" /></td>
   	  </tr>
     	<tr>
     	  <td class="std_detail_side_labels">Domicile:</td>
     	  <td class="std_detail_values"><select name="domicile" class="form_text_boxes"  id="domicile" onblur="validate_domicile();" onchange="validate_domicile();"/>
           <option value="0"> Domicile</option>
    <option value="Abbottabad" <?php if($genral_record['domicile'] == "Abbottabad"){echo "selected=\"selected\""; } ?>>Abbottabad</option>
    <option value="Bannu" <?php if($genral_record['domicile'] == "Banuu"){echo "selected=\"selected\""; } ?>>Bannu</option>
    <option value="Battagram"<?php if($genral_record['domicile'] == "Battagram"){echo "selected=\"selected\""; } ?> >Battagram</option>
    <option value="Buner" <?php if($genral_record['domicile'] == "Buner"){echo "selected=\"selected\""; } ?>>Buner</option>
    <option value="Charsadda"<?php if($genral_record['domicile'] == "Charsadda"){echo "selected=\"selected\""; } ?> >Charsadda</option>
    <option value="Chitral" <?php if($genral_record['domicile'] == "Chitral"){echo "selected=\"selected\""; } ?>>Chitral</option>
    <option value="Dera Ismail Khan" <?php if($genral_record['district'] == "Dera Ismail Khan"){echo "selected=\"selected\""; } ?>>Dera Ismail Khan</option>
    <option value="Haripur" <?php if($genral_record['domicile'] == "Haripur"){echo "selected=\"selected\""; } ?>>Haripur</option>
    <option value="hangu" <?php if($genral_record['domicile'] == "hangu"){echo "selected=\"selected\""; } ?>>Hangu</option>
    <option value="Karak" <?php if($genral_record['domicile'] == "Karak"){echo "selected=\"selected\""; } ?>>Karak</option>
    <option value="Kohat" <?php if($genral_record['domicile'] == "Kohat"){echo "selected=\"selected\""; } ?>>Kohat</option>
    <option value="Kohistan" <?php if($genral_record['domicile'] == "Kohistan"){echo "selected=\"selected\""; } ?>>Kohistan</option>
    <option value="Lakki Marwat" <?php if($genral_record['domicile'] == "Lakki Marwat"){echo "selected=\"selected\""; } ?>>Lakki Marwat</option>
    <option value="Lower Dir"<?php if($genral_record['domicile'] == "Lower Dir"){echo "selected=\"selected\""; } ?> >Lower Dir</option>
    <option value="Malakand"<?php if($genral_record['domicile'] == "Malakand"){echo "selected=\"selected\""; } ?>>Malakand</option>
    <option value="Mansehra" <?php if($genral_record['domicile'] == "Mansehra"){echo "selected=\"selected\""; } ?>>Mansehra</option>
    <option value="Mardan" <?php if($genral_record['domicile'] == "Mardan"){echo "selected=\"selected\""; } ?>>Mardan</option>
    <option value="Nowshera" <?php if($genral_record['domicile'] == "Nowshera"){echo "selected=\"selected\""; } ?>>Nowshera</option>
    <option value="Peshawar" <?php if($genral_record['domicile'] == "Peshawar"){echo "selected=\"selected\""; } ?>>Peshawar</option>
    <option value="Shangla" <?php if($genral_record['domicile'] == "Shangla"){echo "selected=\"selected\""; } ?>>Shangla</option>
    <option value="Swabi" <?php if($genral_record['domicile'] == "Swabi"){echo "selected=\"selected\""; } ?>>Swabi</option>
    <option value="Swat" <?php if($genral_record['domicile'] == "Swat"){echo "selected=\"selected\""; } ?>>Swat</option>
    <option value="Tank" <?php if($genral_record['domicile'] == "Tank"){echo "selected=\"selected\""; } ?>>Tank</option>
    <option value="Tor Ghar"<?php if($genral_record['domicile'] == "Tor Ghar"){echo "selected=\"selected\""; } ?> >Tor Ghar</option>
    <option value="Upper Dir"<?php if($genral_record['domicile'] == "Upper Dir"){echo "selected=\"selected\""; } ?> >Upper Dir</option>
          </select> </td>
     	  <td class="std_detail_side_labels">District:</td>
     	  <td class="std_detail_values"><select name="district" class="form_text_boxes" title="Select district" id="district" onblur="return validate_student_district();" onchange="return validate_student_district();">
    <option value="0"> District</option>
    <option value="Abbottabad" <?php if($genral_record['district'] == "Abbottabad"){echo "selected=\"selected\""; } ?>>Abbottabad</option>
    <option value="Bannu" <?php if($genral_record['district'] == "Banuu"){echo "selected=\"selected\""; } ?>>Bannu</option>
    <option value="Battagram"<?php if($genral_record['district'] == "Battagram"){echo "selected=\"selected\""; } ?> >Battagram</option>
    <option value="Buner" <?php if($genral_record['district'] == "Buner"){echo "selected=\"selected\""; } ?>>Buner</option>
    <option value="Charsadda"<?php if($genral_record['district'] == "Charsadda"){echo "selected=\"selected\""; } ?> >Charsadda</option>
    <option value="Chitral" <?php if($genral_record['district'] == "Chitral"){echo "selected=\"selected\""; } ?>>Chitral</option>
    <option value="Dera Ismail Khan" <?php if($genral_record['district'] == "Dera Ismail Khan"){echo "selected=\"selected\""; } ?>>Dera Ismail Khan</option>
    <option value="Haripur" <?php if($genral_record['district'] == "Haripur"){echo "selected=\"selected\""; } ?>>Haripur</option>
    <option value="hangu" <?php if($genral_record['district'] == "hangu"){echo "selected=\"selected\""; } ?>>Hangu</option>
    <option value="Karak" <?php if($genral_record['district'] == "Karak"){echo "selected=\"selected\""; } ?>>Karak</option>
    <option value="Kohat" <?php if($genral_record['district'] == "Kohat"){echo "selected=\"selected\""; } ?>>Kohat</option>
    <option value="Kohistan" <?php if($genral_record['district'] == "Kohistan"){echo "selected=\"selected\""; } ?>>Kohistan</option>
    <option value="Lakki Marwat" <?php if($genral_record['district'] == "Lakki Marwat"){echo "selected=\"selected\""; } ?>>Lakki Marwat</option>
    <option value="Lower Dir"<?php if($genral_record['district'] == "Lower Dir"){echo "selected=\"selected\""; } ?> >Lower Dir</option>
    <option value="Malakand"<?php if($genral_record['district'] == "Malakand"){echo "selected=\"selected\""; } ?>>Malakand</option>
    <option value="Mansehra" <?php if($genral_record['district'] == "Mansehra"){echo "selected=\"selected\""; } ?>>Mansehra</option>
    <option value="Mardan" <?php if($genral_record['district'] == "Mardan"){echo "selected=\"selected\""; } ?>>Mardan</option>
    <option value="Nowshera" <?php if($genral_record['district'] == "Nowshera"){echo "selected=\"selected\""; } ?>>Nowshera</option>
    <option value="Peshawar" <?php if($genral_record['district'] == "Peshawar"){echo "selected=\"selected\""; } ?>>Peshawar</option>
    <option value="Shangla" <?php if($genral_record['district'] == "Shangla"){echo "selected=\"selected\""; } ?>>Shangla</option>
    <option value="Swabi" <?php if($genral_record['district'] == "Swabi"){echo "selected=\"selected\""; } ?>>Swabi</option>
    <option value="Swat" <?php if($genral_record['district'] == "Swat"){echo "selected=\"selected\""; } ?>>Swat</option>
    <option value="Tank" <?php if($genral_record['district'] == "Tank"){echo "selected=\"selected\""; } ?>>Tank</option>
    <option value="Tor Ghar"<?php if($genral_record['district'] == "Tor Ghar"){echo "selected=\"selected\""; } ?> >Tor Ghar</option>
    <option value="Upper Dir"<?php if($genral_record['district'] == "Upper Dir"){echo "selected=\"selected\""; } ?> >Upper Dir</option>
   	    </select>     	    </td>
   	  </tr>
     	<tr>
     	  <td class="std_detail_side_labels">Nationality:</td>
     	  <td class="std_detail_values"><select name="nationality" class="form_text_boxes" id="nationality" onblur="validate_nationality();" onchange="validate_nationality();" />
          <option value="0">Nationality</option>
          <option value="Pakistani"<?php if($genral_record['nationality']=="Pakistani"){echo "selected=\"selected\"";} ?>>Pakistani</option>
          <option value="Afghani" <?php if($genral_record['nationality']=="Afghani"){echo "selected=\"selected\"";} ?>>Afghani</option>
          <option value="Other" <?php if($genral_record['nationality']=="Other"){echo "selected=\"selected\"";} ?>>Other</option>
          </select> </td>
     	  <td class="std_detail_side_labels">Religon:</td>
     	  <td class="std_detail_values"><select name="religion"  class="form_text_boxes" id="religion" onblur="validate_religion();" onchange="validate_religion();"/>
          <option value="0" <?php if($genral_record['relegion']==""){echo "selected=\"selected\"";} ?>  >Relegion</option>
          <option value="Islam" <?php if($genral_record['relegion']=="Islam"){echo "selected=\"selected\"";} ?>>Islam</option>
          <option value="Christian" <?php if($genral_record['relegion']=="Christian"){echo "selected=\"selected\"";} ?>>Christian</option>
          <option value="Ahmadi" <?php if($genral_record['relegion']=="Ahmadi"){echo "selected=\"selected\"";} ?>>Ahmadi</option>
          <option value="Sikh" <?php if($genral_record['relegion']=="Sikh"){echo "selected=\"selected\"";} ?>>Sikh</option>
          </select>     	    </td>
       <tr>
       
          <td class="std_detail_side_labels">Campus:</td>
          <td class="std_detail_values" style="border-radius:0 0 0px 0px;"><select name="campus" class="form_text_boxes" id="student_campus" title="select Campus" onchange="return get_department();" onblur="return  validate_student_campus();" >
          <option value="0">campus</option>
          <?php
		   $campuses= get_all_campus();
		   $student_campus=$genral_record['campus'];
		   while($result=mysql_fetch_array($campuses)){
			   if($student_campus == $result['id']){
				   echo "<option value=\"$result[id]\" selected=\"selected\" >$result[campus_name]</option>";
			   }else{
			      echo  "<option value=\"{$result['id']}\">$result[campus_name]</option>" ;
		       }
		   }
		    ?>
          
          </select> </td>
          <td class="std_detail_side_labels" style="border-radius:0px 0px 0px 0px;">Department:</td>
          <td class="std_detail_values"><select name="department" class="form_text_boxes" id="department" title="select Department" onblur="validate_student_department()" id="student_department">
             <option value="0">Department</option>
             <?php
			 $departments=get_department_by_campus_id($student_campus);
			 $student_department=$genral_record['department'];
			 while($result=mysql_fetch_array($departments)){
				 if($result['id']==$student_department){
					 echo "<option value=\"$result[id]\" selected=\"selected\">$result[department_name]</option>";
				 }else{
					 echo "<option value=\"$result[id]\">$result[department_name]</option>";
				 }
			 }//end of while loop
			 
			 ?>
               
           
          </select>  </td>
         
          
          
          
       
          </tr>
          
           <tr>
        	<td class="std_detail_side_labels" style="border-radius:0px 0 0 0px;">Date of Birth:</td>
            <td class="std_detail_values"><input name="dob" type="text" class="form_text_boxes" title="enter Student Name" value="<?php echo $genral_record['dob']; ?>" onblur="return validate_student_dob();" id="student_dob"/></td>
            <td class="std_detail_side_labels">Email:</td>
            <td class="std_detail_values" style="border-radius:0 0px px 0px;"><input name="email" type="text" class="form_text_boxes" title="enter Father name" value="<?php echo $genral_record['email']; ?>" id="email" onblur="return validate_email_address();" />              </td>
        </tr>
        
        <tr>
        	<td class="std_detail_side_labels" style="border-radius:0px 0 0 8px;">Study Programe:</td>
            <td class="std_detail_values"><select name="study_program" class="form_text_boxes" id="student_study_programe" title="select study program" onblur="validate_student_study_programe();" id="student_study_programe" onchange="validate_student_study_programe();">
            <option value="0">select Program </option>
            <option value="Bs Hons" <?php if($genral_record['study_program']=="Bs Hons"){echo "selected=\"selected\"  ";}     ?>>Bs Hons</option>
            <option value="MSc" <?php if($genral_record['study_program']=="MSc"){echo "selected=\"selected\"  ";}     ?>>MSC</option>
            <option value="MA"  <?php if($genral_record['study_program']=="MA"){echo "selected=\"selected\"  ";}     ?> >MA</option>
            <option value="Mcs"  <?php if($genral_record['study_program']=="Mcs"){echo "selected=\"selected\"  ";}     ?>>MSC</option>
            <option value="Ms" <?php if($genral_record['study_program']=="Ms"){echo "selected=\"selected\"  ";}     ?>  >MS</option>
            <option value="M.ED"  <?php if($genral_record['study_program']=="M.ED"){echo "selected=\"selected\"  ";}     ?> >M.ED</option>
            <option value="B.ED"  <?php if($genral_record['study_program']=="B.ED"){echo "selected=\"selected\"  ";}     ?>  >B.ED</option>
            <option value="M.Phil"  <?php if($genral_record['study_program']=="M.Phil"){echo "selected=\"selected\"  ";}     ?> >M.Phil</option>
            <option value="Phd" <?php if($genral_record['study_program']=="Phd"){echo "selected=\"selected\"  ";}     ?> >PHD</option>
           
          </select></td>
            <td class="std_detail_side_labels">&nbsp;</td>
            <td class="std_detail_values" style="border-radius:0 0px 8px 0px;">&nbsp;              </td>
        </tr>
          
          
      </table>
     
     <br />
     
    
     
     <table  class="std_detail_info_table">
     <caption>
     Contact Information
     </caption>
     	<tr>
        	<td class="std_detail_side_labels" style="border-radius:8px 0 0 0;">Cell no:</td>
            <td class="long_row" style="border-radius:0 8px 0px 0px;"><input name="cell" type="text" class="form_text_boxes" value="<?php echo $genral_record['cell']; ?>" id="cell" onblur="return validate_student_cell_no();" onkeydown="return add_dashes_cell_no();" onkeyup="return validate_cell_char();"/>              </td>
        </tr>
     	<tr>
     	  <td class="std_detail_side_labels">Present Address:</td>
     	  <td class="long_row"><textarea name="present_address" class="form_text_areas"  id="address_postal" onkeyup="return validate_present_address();">
          <?php echo $genral_record['present_address']; ?></textarea>     	    </td>
   	    </tr>
     	<tr>
     	  <td class="std_detail_side_labels" style="border-radius:0px 0px 0px 8px;">Permanent Address:</td>
     	  <td class="long_row" style="border-radius:0 0 8px 0px;"><textarea name="permanent_address" class="form_text_areas" id="permanent_address" title="enter permanent address" onkeyup="return validate_student_permanent_address();"><?php echo $genral_record['permanent_address']; ?></textarea>     	    </td>
   	  </tr>
     </table>
    
      <br />
      
      
        <table width="781" class="form_table" id="my_table">
     <caption>Account Record</caption>
    	<tr class="form_table_labels">
        	<td width="137">Receipt No</td>
            <td width="103">Receipt Date</td>
            <td width="100">Form No</td>
            <td width="112">Amount</td>
            <td width="286">Semester</td>
        </tr>
        
        <?php
		$sno=1;
		while ($account_records= mysql_fetch_array($account_record)){
			$receipt_unique_id = $sno."a";
		    $receipt_date_unique_id=$sno."b";
			$form_no_unique_id=$sno."c";
			$amount_unique_id=$sno."d";
			$semester_unique_id=$sno."e";
		echo "<tr class=\"form_table_marks\">";
		echo "<td><input type=\"text\" name=\"receipt_no[]\" class=\"number_inputs\" value=\"{$account_records[reciept_no]}\" onkeyup=\"validate_receipt_no('$receipt_unique_id');\" id=\"$receipt_unique_id\"/></td>";
		echo "<td><input type=\"text\" class=\"number_inputs\" name=\"receipt_date[]\" value=\"{$account_records[reciept_date]}\" id=\"$receipt_date_unique_id\" onkeyup=\"return validate_receipt_date('$receipt_date_unique_id');\" onkeydown=\"return show_cal('$receipt_date_unique_id'); \" /> </td>";
		echo "<td><input type=\"text\" class=\"number_inputs\" name=\"form_no[]\" value=\"{$account_records[form_no]}\" onkeyup=\"return validate_form_no('$form_no_unique_id');\" id=\"$form_no_unique_id\" /></td>";
		echo  "<td><input name=\"amount[]\" type=\"text\" class=\"number_inputs\" value=\"{$account_records[amount]}\"id=\"$amount_unique_id\"  onkeyup=\"return validate_amount('$amount_unique_id');\" /></td>";	  
		echo "<td><input name=\"semester[]\" type=\"text\" class=\"number_inputs\" value=\"{$account_records[semester]}\" id=\"$semester_unique_id\" onkeyup=\"return validate_semester('$semester_unique_id');\" /></td>";
		echo "<input type=\"hidden\" name=\"account_id[]\" value=\"{$account_records[id]}\" />";
		echo "</tr>";

	
		$sno++;
		}
		
		?>
        
      </table>

        
        
        
      
      
     
     <table width="781" class="form_table" id="my_table">
     <caption>Acadamic Record</caption>
    	<tr class="form_table_labels">
        	<td width="137">Level of Education</td>
            <td width="103">Obtained Marks</td>
            <td width="100">Total Marks</td>
            <td width="112">Percentage</td>
            <td width="286">Board/Institute</td>
        </tr>
    	<tr class="form_table_marks">
    	  <td>SSC</td>
          
    	  <td><input type="text" class="number_inputs" name="ssc_obtain_marks" value="<?php echo $academic_record['ssc_obtain_marks']; ?>" onkeyup="return validate_ssc_marks_obtain();" id="ssc_obtain_marks" /></td>
    	  <td><input type="text" class="number_inputs" name="ssc_total_marks" value="<?php echo $academic_record['ssc_total_marks']; ?>" onkeyup="return  validate_ssc_marks_total();" id="ssc_marks_total"/></td>
    	  <td><input name="ssc_percentage" type="text" class="number_inputs" value="<?php echo $academic_record['ssc_percentage']; ?>" readonly="readonly" /></td>
    	 <td><input name="ssc_board" type="text" class="number_inputs" value="<?php echo $academic_record['ssc_board']; ?>" id="ssc_board" onkeyup="return  validate_ssc_board();"/></td>
  	  </tr>
    	<tr class="form_table_marks">
    	  <td>HSSC</td>
    	  <td><input type="text" class="number_inputs" name="hssc_obtain_marks" value="<?php echo $academic_record['hssc_obtain_marks']; ?>" onkeyup="return validate_hssc_marks_obtain();" id="hssc_marks_obtain" /></td>
    	  <td><input type="text" class="number_inputs" name="hssc_total_marks" value="<?php echo $academic_record['hssc_total_marks']; ?>" id="hssc_marks_total" onkeyup="return validate_hssc_total_marks();" /></td>
    	  <td><input name="hssc_percentage" type="text" class="number_inputs" value="<?php echo $academic_record['hssc_percentage']; ?>" readonly="readonly" /></td>
    	  <td><input name="hssc_board" type="text" class="number_inputs" value="<?php echo $academic_record['hssc_board']; ?>" id="hssc_board" onkeyup="validate_hssc_board();" /></td>
  	  </tr>
    	<tr class="form_table_marks">
          <?php if($academic_record['ba_bsc_obtain_marks'] !=0) {  ?>
    	  <td>BA/BSc</td>
    	  <td><input type="text" class="number_inputs" name="ba_bsc_obtain_marks" value="<?php echo $academic_record['ba_bsc_obtain_marks']; ?>" id="ba_bsc_obtain_marks" onkeyup="return validate_ba_bsc_marks_obtain();"/></td>
    	  <td><input type="text" class="number_inputs" name="ba_bsc_total_marks" value="<?php echo $academic_record['ba_bsc_total_marks']; ?>" onkeyup="return validate_ba_bsc_total_marks();" id="ba_bsc_total_marks"/></td>
    	  <td><input name="ba_bsc_percentage" type="text" class="number_inputs" value="<?php echo $academic_record['ba_bsc_percentage']; ?>" readonly="readonly" /></td>
    	<td><input name="ba_bsc_board" type="text" class="number_inputs" value="<?php echo $academic_record['ba_bsc_board']; ?>" id="ba_bsc_board" onkeyup="return validate_ba_bsc_board();" /></td>
  	  </tr>
      <?php  } ?>
      
       <?php if($academic_record['ma_msc_obtain_marks'] !=0) {  ?>
    	<tr class="form_table_marks">
    	  <td>MA/MSc</td>
    	  <td><input type="text"  class="number_inputs" name="ma_msc_obtain_marks" value="<?php echo $academic_record['ma_msc_obtain_marks']; ?>" id="ma_msc_marks_obtain" onkeyup="return  validate_ma_msc_marks_obtain();"/></td>
    	  <td><input type="text" class="number_inputs" name="ma_msc_total_marks" value="<?php echo $academic_record['ma_msc_total_marks']; ?>" onkeyup="return validate_ma_msc_total_marks();" id="ma_msc_total_marks"/></td>
    	  <td><input name="ma_msc_percentage" type="text" class="number_inputs" value="<?php echo $academic_record['ma_msc_percentage']; ?>" readonly="readonly" /></td>
    	 <td><input name="ma_msc_board" type="text" class="number_inputs" value="<?php echo $academic_record['ma_msc_board']; ?>" onkeyup="return validate_ma_msc_board();" id="ma_msc_board" /></td>
  	  </tr>
      
      <?php } ?>
      
        <?php   if($academic_record['other_obtain_marks'] !=0 ){ ?>
    	<tr class="form_table_marks">
    	  <td>Others</td>
    	  <td><input type="text" class="number_inputs" name="other_obtain_marks" value="<?php echo $academic_record['other_obtain_marks']; ?>" onkeyup="return  validate_other_marks_obtain()" id="other_obtain_marks" /></td>
    	  <td><input type="text" class="number_inputs" name="other_total_marks" value="<?php echo $academic_record['other_total_marks']; ?>" onkeyup="return  validate_other_total_marks();" id="other_total_marks"/></td>
    	  <td><input name="other_percentage" type="text" class="number_inputs" value="<?php echo $academic_record['other_percentage']; ?>" readonly="readonly" /></td>
    	 <td><input name="other_board" type="text" class="number_inputs" value="<?php echo $academic_record['other_board']; ?>" onkeyup="return  validate_other_board();" id="other_board"
         /></td>
  	  </tr>
      <?php } ?>
    	<tr class="form_table_marks">
    	  <td>&nbsp;</td>
    	  <td>&nbsp;</td>
    	  <td>&nbsp;</td>
    	  <td>&nbsp;</td>
    	  <td>&nbsp;</td>
  	  </tr>
         <input type= "hidden" name="id" value="<?php echo $student_id; ?>"  />
       <tr class="form_table_marks">
        	<td align="center" colspan="5"><input type="submit" value="Update Record" name="upd_btn"  class="action_btns"  /></td>
    	  </tr>
      
     </table>

</form>
     
</div><!--end of main_content -->


</div><!--end of content -->
</div><!--end of container -->
<?php include_once("includes/footer.php");?>
</body>
</html>
<?php mysql_close($connection); ?>