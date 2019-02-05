<?php
 session_start(); 
	require_once("includes/connection.php");
	require_once("includes/functions.php");
	
	if($_SESSION['logged']!="true"){
	redirect_to("index.php?login=false");
	}
	if(!isset($_GET['id'])){
		redirect_to("view_all_campuses_record.php?id_selection=false");
	}
	
	if(isset($_GET['account_record_insertion'])){
		
	 if($_GET['account_record_insertion']=="true"){
		 $notify="account record added successfully";
	 }else{
		 $notify="account record not added";
	 }
	}else{
		$notify=NULL;
	}
	
	if(isset($_GET['upd'])&& ($_GET['upd']=="true")){
		$update_message="Student Record Updated";
	}else{
		$update_message=NULL;
	}
	$id=$_GET['id'];
	$genral_record = get_student_genral_information_by_id($id);
    $academic_record= get_student_academic_information_by_id($id);
    $account_record= get_student_account_information_by_id($id);
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
   function confirm_del(){
		var del = confirm("Are you sure you want to delete this record?");
		return del;   
   }
  
   
   
</script>
</head>
<body>
<div id="container">
<?php include_once("includes/header.php"); ?>
<div id="content">



<div id="main_content">
 	 <h1>Student Detail Information</h1>
 		<br />
          <div id="error_p" ><?php
		  echo $notify;
		  echo $update_message;
		    
		         ?> </div>
        
        <div id="table_img">
         
      <img src="<?php echo "uploads/".$id.".jpg" ?>" height="150" width="150" />
      </div>
     <div id="table">
     <table class="std_detail_info_table">
     <caption>Student General Information<span class="right_caption"><a href="<?php echo "delete_student_record.php?id={$genral_record['id']}&campus_id={$genral_record['campus']}&department_id={$genral_record['department']}"; ?>" onclick="return confirm_del();">Delete</a> | <a href="update_student_record.php?id=<?php echo $genral_record['id']; ?>">Update</a></span></caption>
     	<tr>
        	<td class="std_detail_side_labels" style="border-radius:8px 0 0 0;">Student Name:</td>
            <td class="std_detail_values"><?php echo $genral_record['name']; ?></td>
            <td class="std_detail_side_labels">Father Name:</td>
            <td class="std_detail_values" style="border-radius:0 8px 0px 0px;"><?php echo $genral_record['father_name']; ?></td>
        </tr>
     	<tr>
     	  <td class="std_detail_side_labels">Gender:</td>
     	  <td class="std_detail_values"><?php if($genral_record['gender']=="M"){echo "Male";}else {echo "Female";} ?></td>
     	  <td class="std_detail_side_labels">Roll no:</td>
     	  <td class="std_detail_values"><?php echo $genral_record['roll_no']; ?></td>
   	  </tr>
     	<tr>
     	  <td class="std_detail_side_labels">Domicile:</td>
     	  <td class="std_detail_values"><?php echo $genral_record['domicile']; ?></td>
     	  <td class="std_detail_side_labels">District:</td>
     	  <td class="std_detail_values"><?php echo $genral_record['district']; ?></td>
   	  </tr>
     	<tr>
     	  <td class="std_detail_side_labels">Nationality:</td>
     	  <td class="std_detail_values"><?php echo $genral_record['nationality']; ?></td>
     	  <td class="std_detail_side_labels">Religon:</td>
     	  <td class="std_detail_values"><?php echo $genral_record['relegion']; ?></td>
       <tr>
          <td class="std_detail_side_labels" style="border-radius:0px 0px 0px 0px;">Department:</td>
          <td class="std_detail_values">
		  <?php
		  
		   $std_department= $genral_record['department'];
		   $student_department=get_student_department($std_department);
		   
		   echo $student_department['department_name'];
		 
		   ?></td>
          <td class="std_detail_side_labels">Campus:</td>
          <td class="std_detail_values" style="border-radius:0 0 0px 0px;">
		  <?php 
		  $std_campus=$genral_record['campus'];
		  $student_campus=get_student_campus($std_campus);
		  
		   echo $student_campus['campus_name'];
		 ?></td>
       </tr>
       <tr>
           <td class="std_detail_side_labels" style="border-radius:0 0 0px 8px">Student CNIC:</td>
           <td class="std_detail_values"><?php echo $genral_record['cnic'];  ?></td>
           <td class="std_detail_side_labels">Father CNIC:</td>
           <td class="std_detail_values " style="border-radius:0 0 8px 0"><?php echo $genral_record['father_cnic'];    ?></td>
       </tr>
      </table>
    
      </div> <!--end of table_img Div -->
     
     <br />

     <br />
   
     
     <table  class="std_detail_info_table">
     <caption>
     Contact Information
     </caption>
     	<tr>
        	<td class="std_detail_side_labels" style="border-radius:8px 0 0 0;">Cell no:</td>
            <td class="long_row" style="border-radius:0 8px 0px 0px;"><?php echo $genral_record['cell']; ?></td>
        </tr>
     	<tr>
     	  <td class="std_detail_side_labels">Present Address:</td>
     	  <td class="long_row"><?php echo $genral_record['present_address']; ?></td>
   	    </tr>
     	<tr>
     	  <td class="std_detail_side_labels" style="border-radius:0px 0px 0px 8px;">Permanent Address:</td>
     	  <td class="long_row" style="border-radius:0 0 8px 0px;"><?php echo $genral_record['permanent_address']; ?></td>
   	  </tr>
     </table>
    
      <br />
      
       <table width="693" class="std_detail_info_table" id="my_table">
     <caption>Account Record</caption>
    	<tr class="form_table_labels" style="background-color:#2F5561">
        	<td width="126" >Receipt No</td>
            <td width="99">Receipt Date</td>
            <td width="94">Form No</td>
            <td width="106">Amount</td>
            <td width="244">Semester</td>
        </tr>
        <?php
		while($account_records=mysql_fetch_array($account_record)){
		
    	echo "<tr class=\"form_table_marks\">";
    	echo "<td>{$account_records['reciept_no']}</td>";
    	echo " <td> {$account_records['reciept_date']}</td>";
    	echo " <td> {$account_records['form_no']} </td>";
    	echo " <td>{$account_records['amount']}</td>";
    	echo " <td> {$account_records['semester']}</td>";
  	    echo "</tr>";
		}
      ?>
      </table>
       <table width="699">
       <tr>
       <td width="0">&nbsp; </td>
         <td width="0">&nbsp; </td>
         <td width="0">&nbsp; </td>
         <td width="593">&nbsp; </td>
       </tr>
       <tr>
         <td width="0">&nbsp; </td>
         <td width="0">&nbsp; </td>
         <td width="0">&nbsp; </td>
         <td width="600">&nbsp; </td>
         <td width="86"><a href="<?php echo "add_account_record.php?id=$id"; ?>"><input type="button" name="add_account_btn" value="Add Account Record" class="action_btns" style="
   width: 139px;"></a></td>
       </tr>
         
      </table>
     

    
  <!--end of account record -->
     
     <table width="781" class="std_detail_info_table" id="my_table">
     <caption>Acadamic Record</caption>
    	<tr class="form_table_labels" style="background-color:#2F5561">
        	<td width="137">Level of Education</td>
            <td width="103">Obtained Marks</td>
            <td width="100">Total Marks</td>
            <td width="112">Percentage</td>
            <td width="286">Board/Institute</td>
        </tr>
    	<tr class="form_table_marks">
    	  <td>SSC</td>
    	  <td><?php echo $academic_record['ssc_obtain_marks']; ?></td>
    	  <td><?php echo $academic_record['ssc_total_marks']; ?></td>
    	  <td><?php echo $academic_record['ssc_percentage']; ?></td>
    	  <td><?php echo $academic_record['ssc_board'];  ?></td>
  	  </tr>
    	<tr class="form_table_marks">
    	  <td>HSSC</td>
    	  <td><?php echo $academic_record['hssc_obtain_marks']; ?></td>
    	  <td><?php echo $academic_record['hssc_total_marks']; ?></td>
    	  <td><?php echo $academic_record['hssc_percentage']; ?></td>
    	  <td><?php echo $academic_record['hssc_board'];  ?></td>
  	  </tr>
    	<tr class="form_table_marks">
    	  <td>BA/BSc</td>
    	  <td><?php echo $academic_record['ba_bsc_obtain_marks']; ?></td>
    	  <td><?php echo $academic_record['ba_bsc_total_marks']; ?></td>
    	  <td><?php echo $academic_record['ba_bsc_percentage']; ?></td>
    	  <td><?php echo $academic_record['ba_bsc_board'];  ?></td>
  	  </tr>
    	<tr class="form_table_marks">
    	  <td>MA/MSc</td>
    	  <td><?php echo $academic_record['ma_msc_obtain_marks']; ?></td>
    	  <td><?php echo $academic_record['ma_msc_total_marks']; ?></td>
    	  <td><?php echo $academic_record['ma_msc_percentage']; ?></td>
    	  <td><?php echo $academic_record['ma_msc_board'];  ?></td>
  	  </tr>
    	<tr class="form_table_marks">
    	  <td>Others</td>
    	  <td><?php echo $academic_record['other_obtain_marks']; ?></td>
    	  <td><?php echo $academic_record['other_total_marks']; ?></td>
    	  <td><?php echo $academic_record['other_percentage']; ?></td>
    	  <td><?php echo $academic_record['other_board'];  ?></td>
  	  </tr>
     </table>
     
     
</div><!--end of main_content -->


</div><!--end of content -->
</div><!--end of container -->
<?php include_once("includes/footer.php");?>

</body>
</html>
<?php mysql_close($connection); ?>