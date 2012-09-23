<?php
session_start();
require_once('../session.php');
require_once('../config.php');
require_once('../db.php');
if(!$login) header("location : ../index.php");

$result = mysql_query("SELECT username,pw FROM user WHERE id=".$uid);
$row = mysql_fetch_row($result);
$username = $row[0];$passwd = $row[1];

$home_type = 'null';
if(isset($_GET['type'])) $home_type = $_GET['type'];
	//if($home_type == 'recommendation')
	//	$dom->load("http://127.0.0.1/api/recommendation/recsys_reason_xml.php?uid=" .$_SESSION['uid']);
	//else
	//	$dom->load("http://127.0.0.1/api/user/" . $home_type . ".php?uid=" .$_SESSION['uid']);
	//$related_authors = array();
	//$related_users = array();
	//$papers = $dom->getElementsByTagName('paper');
	//if($home_type == 'recommendation'){
	//	if($papers->length == 0 && strlen($keywords) > 0)
	//	{
	//		$keywords = trim($keywords, " ,.;");
	//		$keywords = str_replace(',', '|', $keywords);
	//		$dom->load('http://127.0.0.1/api/search/search.php?n=10&query=' . str_replace(' ','+',$keywords));
	//		$papers = $dom->getElementsByTagName('paper');
	//	}
	//}

?>

<html>
	<head>
		<title><?php echo $SITE_NAME; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="../main.css" />

		<script src="../jquery.js" type="text/javascript"></script>
		<script type="text/javascript">                                         
		$(document).ready(function() {
		$("#edituser_add").click(function() {
			$("#add").css('display','inline'); 
			$("#del").css('display','none'); 
			$("#change").css('display','none'); 
		});
		$("#edituser_del").click(function() {
			$("#add").css('display','none'); 
			$("#del").css('display','inline'); 
			$("#change").css('display','none'); 
		});
		$("#edituser_change").click(function() {
			$("#add").css('display','none'); 
			$("#del").css('display','none'); 
			$("#change").css('display','inline'); 
		});
		$("#editgroup_add").click(function() {
			$("#add").css('display','inline'); 
			$("#del").css('display','none'); 
			$("#change").css('display','none'); 
		});
		$("#editgroup_del").click(function() {
			$("#add").css('display','none'); 
			$("#del").css('display','inline'); 
			$("#change").css('display','none'); 
		});
		$("#editgroup_change").click(function() {
			$("#add").css('display','none'); 
			$("#del").css('display','none'); 
			$("#change").css('display','inline'); 
		});
		});                         
		</script> 
	</head>
	
	<body>
		<div id="content">
			<div id="header">
				<div style="width:100%;float:left;">
				<div id="toolbar">
					<span>Hi <?php echo $username; ?></span>&nbsp;&nbsp;
					<span><a href="../index.php">Home Page</a></span>&nbsp;&nbsp;
					<span><a href="../logout.php">Log out</a></span>&nbsp;&nbsp;
				</div>
				</div>
				<div id="logo"><?php echo $SITE_NAME; ?></div>
			</div>
			<div id="main">
			<?php
			if($home_type == 'edituser'){
				require_once "edituser.php";
			}else if($home_type == 'editgroup'){
				require_once "editgroup.php";
			}
			else{
			?>
			<span>Welcome to Admin page!</span>
			<?php } ?>
			</div>
			<div id="side">
				<h2>Admin</h2>
				<div class="related_author">
					<span><a href="./index.php?type=edituser">Edit Users</a></span>
					<span><a href="./index.php?type=editgroup">Edit Usergroup</a></span>
					<span><a href="../index.php">Back</a></span>
				</div>
			</div>
		</div>
		<div id="foot">Made by Redswallow 2012</div>
		<div id="feedbackcode"></div>
	</body>
</html>