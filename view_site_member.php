<?php 
 session_start();
	require_once("includes/connection.php");
	require_once("includes/functions.php");
	if($_SESSION['logged']!="true"){
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
	<h1>Site Members</h1>
	  <div id="error_p" ><?php  
		  
			  ?> </div>
              
       <?php
	   $site_merbers=get_all_site_members();
	   if(mysql_num_rows($site_merbers)==0){
		   
		   echo "Site Member Not Exist";
	   }else{
	      if($site_merbers !=false){
		
	   
	   
	   
	   ?> 
       
          <table width="829" class="rec_view_table">
     <caption>Students Information</caption>
     	<tr id="labels">
        
       
            <td width="150" class="roll_no_class">Name</td>
            <td width="252" style="padding-left:14px">Father Name</td>
            <td width="218">User Name</td>
            <td width="178">Cell</td>
            <td>&nbsp; </td>
           
           
        </tr> 
           <?php
		    $sno = 1;
		   while ($each_member=mysql_fetch_array($site_merbers)){
			
			 if($sno % 2 == 1){
						$class = "class=\"rec_row_odd_site\"";
					}else{
						$class = "class=\"rec_row_even_site\"";
					}
				$html = "<tr $class>
								
								
								
								<td class=\"table_anchor\"><a href=\"view_site_member_details.php?id={$each_member['id']}\">{$each_member['name']}</a></td>
								<td >{$each_member['father_name']}</td>
								<td>{$each_member['user_name']}</td>
								<td> {$each_member['cell_no']}</td>";
								
								$html.="<td><a href=\"delete_member_record.php?id={$each_member['id']}\" onclick=\"return confirm_delete();\">";
							$html.="<img src=\"images/delete.jpg\" width=\"30px\" height=\"20px\" / ></a>";
									
			  echo $html;
			  $sno++;		   
		   } // end of while loop
		   
		 
		    ?>
            </table>
        
        
        <?php }// end of if statment if  site member != false 
	   }// end of else statment if site member Exist Mysql_num_rows?>
		     
      
</div><!--end of main_content -->

</div><!--end of content -->
</div><!--end of container -->
<?php include_once("includes/footer.php");?>
</body>
</html>
<?php mysql_close($connection); ?>