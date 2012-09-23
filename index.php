<?php
session_start();
require_once('session.php');
require_once('config.php');
if($login){
	require_once('db.php');
	require_once('grantauth.php');
	//require_once("functions.php");
	$result = mysql_query("SELECT username,pw FROM user WHERE id=".$_SESSION['uid']);
	if (!$result) die("error when get information of user");
	$row = mysql_fetch_row($result);
	$username =$row[0];$pw = $row[1];
	$dom = new DOMDocument();
	$home_type = 'recommendation';
	if(isset($_GET['type'])) $home_type = $_GET['type'];
	$sort='id';
	if(isset($_GET['sort'])) $sort = $_GET['sort'];
	if ($home_type=='search'){
		$search_key = $_POST["search_box"];
	}
}
?>
<html>
	<head>
		<title><?php echo $SITE_NAME; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="./main.css" />
		<link rel="stylesheet" href="./pagination.css" />
        <script type="text/javascript" src="./jquery.js"></script>
        <script type="text/javascript" src="./jquery.pagination.js"></script>
		
	</head>
	
	<body>
		<div id="content">
			<div id="header">
				<?php
				if($login){
				?>
				<div style="width:100%;float:left;">
				<div id="toolbar">
					<span>Hi <?php echo $username; ?></span>&nbsp;&nbsp;
					<span><a href="./index.php">Home Page</a></span>&nbsp;&nbsp;
					<span><a href="./logout.php">Log out</a></span>&nbsp;&nbsp;
				</div>
				<!-- can add share span here -->
				</div>
				<?php } else echo "&nbsp;<br>"; ?>
				<div id="logo"><?php echo $SITE_NAME; ?></div>
				<?
				//include('./search/search_bar.php');
				?>
			</div>
			<?php
			if($login==false){
			?>
			<div style="width:100%;float:left;clear:both;margin-top:30px;">
				<div id="intro">
					<h3><?php echo $SITE_NAME; ?> is an academic paper manager system which can : </h3>
					<ul>
						<li>Search academic papers by analyzing your historical preference</li>
						<li>Manager papers and authors with bookmarks</li>
					</ul>
				</div>
				<div id="login">
					<?php require_once('./login_section.php'); ?>
				</div>
			</div>
			<?php
			}
			else{
			?>
				<div id="main">
				<span id="home_type">
					<a href="index.php?type=authors" style="<?php if($home_type=='authors') echo 'background:#E4EEF0'; ?>">Authors</a>
					<a href="index.php?type=papers" style="<?php if($home_type=='papers') echo 'background:#E4EEF0'; ?>">Papers</a>
				</span>
				<?php
					if($home_type =='papers'){
				?>
					<form style="width:100%;float:left;" action="index.php?type=search" method="post">
						<input style="width:80%;float:left;height:26px;line-height:26px;" type="text" name="search_box" class="search_box" value=""/>
						<input class="search_button" type="submit" value="Search" />
					</form>		
				<?php
					if ($watch_right==1){
							require_once "paperlist.php";
						}else{
							echo '<span>Sorry! You have no right to watch!</span>';
						}
					}
					else if($home_type == 'authors'){
						if ($watch_right==1){
							require_once "authorlist.php";
						}else{
							echo '<span>Sorry! You have no right to watch!</span>';
						}
					}
					else if($home_type == 'authorbookmarked'){
						if ($bookmark_right==1){
							require_once "abookmarklist.php";
						}else{
							echo '<span>Sorry! You have no right to bookmark!</span>';
						}
					}
					else if($home_type == 'paperbookmarked'){
						if ($bookmark_right==1){
							require_once "pbookmarklist.php";
						}else{
							echo '<span>Sorry! You have no right to bookmark!</span>';
						}
					}
					else if($home_type == 'search'){
						if ($search_right==1){
							require_once "search.php";
						}else{
							echo '<span>Sorry! You have no right to search!</span>';
						}
					}
					else{
						require_once "info.php";
				?>
					<span>Welcome to user page!</span><br />
					<span>We have collected <?php echo $school_n; ?> schools, <?php echo $author_n; ?> authors and <?echo $paper_n; ?> papers.</span><br />
					<span>You bookmarked <?php echo $user_author_n; ?> authors and <?echo $user_paper_n; ?> papers.</span>
				<?php
					}
				?>
				</div>
				<div id="side">
					<h2>User</h2>
					<div class="related_author">
						<span><a href="./user/edit.php">Edit My Info</a></span>
						<span><a href="./user/display.php">Setting</a></span>
						<?php if($_SESSION["admin"]==true){ ?>
							<span><a href="./admin/index.php">Go to Admin</a></span>
						<?php } ?>
					</div>
					<h2>Bookmarks</h2>
					<div class="related_author">
					<span><a href="./index.php">Home Page</a></span>
					<span><a href="index.php?type=authorbookmarked">Author Bookmarks</a></span>
					<span><a href="index.php?type=paperbookmarked">Paper Bookmarks</a></span>
					</div>
					<h2>Sort by</h2>
					<div class="related_author">
					<span><a href="index.php?type=papers&sort=id">Id</a></span>
					<span><a href="index.php?type=papers&sort=name">Name</a></span>
					<span><a href="index.php?type=papers&sort=year">Year</a></span>
					<span><a href="index.php?type=papers&sort=cite">Cites</a></span>
					</div>
				</div>
				<?php
			}
			?>
		</div>
		<div id="foot">Made by Redswallow 2012</div>
		<div id="feedbackcode"></div>
	</body>
</html>