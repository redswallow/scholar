<?php
session_start();
require_once('../session.php');
require_once('../config.php');
require_once('../db.php');
if(!$login) header("location : ../index.php");


$result = mysql_query("SELECT username,pw FROM user WHERE id=".$uid);
$row = mysql_fetch_row($result);
$username = $row[0];$passwd = $row[1];

if (isset($_POST['edit_b'])){
	if(isset($_POST['username'])){
		if(md5($_POST['passwd']) != $passwd){
			echo "<h2>Please input right old password to edit the info</h2>";
			return;
		}
		if(isset($_POST['passwd_new']) && strlen($_POST['passwd_new']) > 0) $passwd = $_POST['passwd_new'];
		if(isset($_POST['username'])) $username = $_POST['username'];
		if(strlen($passwd) < 6){
			echo "<h2>Password must have more than 6 characters</h2>";
			return;
		}
		$result = mysql_query("update user set pw='" . md5($passwd) . "', username='" . $username . "' where id=" . $_SESSION['uid']);
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
				<form action="edit.php" method="post" style="width:100%;float:left;">
					<div style="float:left;width:100%;"><span>Username&nbsp;</span><input type="text" name="username" class="textinput" value="<?php echo $username; ?>"/></div>
					<div style="float:left;width:100%;"><span>Old Password&nbsp;</span><input type="password" name="passwd" class="textinput" value=""/></div>
					<div style="float:left;width:100%;"><span>New Password&nbsp;</span><input type="password" name="passwd_new" class="textinput" value=""/></div>
					<br />
					<input type="submit" value="Edit" class="button" name="edit_b" />
					<input type="submit" value="Return" class="button" name="return_b" />
				</form>
			</div>
		</div>
	</body>
</html>