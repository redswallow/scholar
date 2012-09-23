<?php
session_start();
require_once('../session.php');
require_once('../config.php');
require_once('../db.php');
if(!$login) header("location : ../index.php");


$result = mysql_query("SELECT username,pw FROM user WHERE id=".$uid);
$row = mysql_fetch_row($result);
$username = $row[0];$passwd = $row[1];


$result=mysql_query("SELECT perpage FROM user where id='$uid'");
$row=mysql_fetch_array($result,MYSQL_NUM);
$perpage=$row[0];


if (isset($_POST['edit_b'])){
	if(isset($_POST['page'])){
		$perpage=$_POST['page'];
		$result = mysql_query("update user set perpage='" . $perpage . "' where id=" . $_SESSION['uid']);
		//if(isset($_POST['callback'])) Header("Location: " . $_POST['callback']);
		Header("Location: ../index.php");
	}
}
if (isset($_POST['return_b'])){
	Header("Location: ../index.php");
}
?>
<html>
	<head>
		<title><?php echo $SITE_NAME; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="../main.css" />
	<head>
	<body>
		<div id="content">
			<div id="header">
			<div style="width:100%;float:left;">
				<div id="toolbar">
					<span>Hi <?php echo $username; ?></span>&nbsp;&nbsp;
					<span><a href="../index.php">Home Page</a></span>&nbsp;&nbsp;
					<span><a href="../logout.php">Log out</a></span>
				</div>
				</div>
				<div id="logo"><?php echo $SITE_NAME; ?></div>
			</div>
			<div id="main">
				<form action="display.php" method="post" style="width:100%;float:left;">
					<div style="float:left;width:100%;"><span>Paper per page&nbsp;</span><input type="text" name="page" class="textinput" value="<?php echo $perpage; ?>"/></div>
					<br />
					<input type="submit" value="Edit" class="button" name="edit_b" />
					<input type="submit" value="Return" class="button" name="return_b" />
				</form>
			</div>
		</div>
	</body>
</html>