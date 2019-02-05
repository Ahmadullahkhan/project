<?php 
	require_once("includes/connection.php");
	require_once("includes/functions.php");

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
<div id="left_col">
<?php include_once("includes/left_col_content.php"); ?>
</div><!--end of left_col -->


<div id="main_content">
	<h1>Campus Detail</h1>
    
</div><!--end of main_content -->
<?php
$campus=$_GET['campus_name'];
?>
  <table class="campuses"> 
     <tr id="top_row"> 
         <td id="sno">S.No</td>
         <td>Department</td>
     </tr>
     <tr class="odd_row">
        <td class="odd_td"> 1</td>
        <td><a href="<?php echo  "view_campus_detail.php?campus_name=Shankar";  ?>">Shankar</a></td>
     </tr> </a>
     <tr class="even_row">
       <td class="even_td"> 2</td>
       <td><a href="<?php echo  "view_campus_detail.php?campus_name=ambar";  ?>"> Ambar</a></td>
     </tr>
      <tr class="odd_row">
       <td class="even_td"> 3</td>
       <td><a href="<?php echo  "view_campus_detail.php?campus_name=Main";  ?>"> Main </a></td>
     </tr>
      <tr class="even_row">
       <td class="even_td">4</td>
       <td><a href="<?php echo  "view_campus_detail.php?campus_name=palusa";  ?>"> Palusa</a></td>
     </tr>
      <tr class="odd_row">
       <td class="odd_td"> 5</td>
       <td><a href="<?php echo  "view_campus_detail.php?campus_name=bunir";  ?>"> Bunir</a></td>
     </tr>
      <tr class="even_row">
       <td class="even_td"> 6</td>
       <td><a href="<?php echo  "view_campus_detail.php?campus_name=pabbo";  ?>"> Pabuu </a></td>
     </tr>
      <tr class="odd_row">
       <td class="odd_td"> 7</td>
       <td><a href="<?php echo  "view_campus_detail.php?campus_name=chitral";  ?>"> Chatral</a></td>
     </tr>
      <tr class="even_row">
       <td class="even_td">8</td>
       <td><a href="<?php echo  "view_campus_detail.php?campus_name=rifat_mahal";  ?>"> Rifat Mahal</a></td>
     </tr>
      <tr class="odd_row">
       <td class="odd_td"> 9</td>
       <td><a href="<?php echo  "view_campus_detail.php?campus_name=karak";  ?>"> Karak </a></td>
     </tr>
     
     </table>   



</div><!--end of content -->
</div><!--end of container -->
<?php include_once("includes/footer.php");?>
</body>
</html>
<?php mysql_close($connection); ?>