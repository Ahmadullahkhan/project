<?php 
	require_once("includes/connection.php");
	

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
<link href="stylesheets/drop_down.css" rel="stylesheet" type="text/css" />
<script type="text/javascript"></script>
<script type="application/javascript" src="scripts/jquery/jquery-1.8.3.js"></script>
<script type="text/javascript" src="scripts/jquery/jquery-ui.js"></script>
<script>
   
</script>
</head>
<body>
<div id="container">
<div id="header">
	<h1>Abdul Wali Khan University, Mardan</h1>
    <h2>Database System For Provost Office</h2>
    <p>Phone: 0937-617383, Fax: 0937-3454545</p>
    <p>Email: email@yahoo.com</p>
  
</div><!--end of header -->

<div id="content">



<div id="main_content">
 <h1>Login</h1>
 <div id="login_box">
 	<p style="color: rgb(20, 19, 19);"><b><marquee behavior="alternate" scrolldelay="200"> Please enter your login information. </marquee>  </b> 	</p>
 	<form name="login_form" id="login_form" method="post" action="process_login.php">
 	  <div align="left">
 	    <table height="113" align="center">
 	      <tr>
 	        <td class="table_td_label">User Name: </td>
 	        <td><input type="text" name="user_name" id="user_name" autofocus="autofocus" /></td>
 	        </tr>
 	      
 	      <tr>
 	        <td class="table_td_label">Password: </td>
 	        <td><input type="password" name="password" id="password"  /></td>
 	        </tr>
 	      
 	      
 	      <tr>
 	        <td>&nbsp;</td>
 	        <td><input type="submit" name="login_btn" class="loginBtn" value="login" /></td>
 	        </tr>
 	      
 	      </table>
 	    </div>

    
    </form>
</div><!--end of login_box -->
</div><!--end of main_content -->


</div><!--end of content -->
</div><!--end of container -->
<?php include_once("includes/footer.php");?>
</body>
</html>
<?php mysql_close($connection); ?>