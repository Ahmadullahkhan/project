<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php
	if(isset($_GET['category_id'])){
		$campus_id= $_GET['category_id'];
		$all_departments=get_department_in_campus_ajax($campus_id);
		
					if($all_departments != FALSE){
						
						 
							while($item = mysql_fetch_array($all_departments)){
								
							    
								$html = "<option value=\"{$item['id']}\">{$item['department_name']}</option>";
							
							echo $html;
							}	
					}
		
	}else{
		redirect_to("purchase_item.php?add=no");	
	}
?>