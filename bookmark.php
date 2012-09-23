<?php
session_start();
require_once('session.php');
require_once('db.php');
$type=$_GET["type"];
$paper_id =$_GET["paper_id"];
$author_id =$_GET["author_id"];
$uid=$_SESSION['uid'];
if($paper_id!=null){
	if($type=='add'){
		mysql_query("insert into user_bookmark_paper (user_id,paper_id) values ('" . $uid . "', '".$paper_id."');");
		Header("Location: index.php?type=papers");
	}
	else if($type=='del'){
		mysql_query("delete from user_bookmark_paper where user_id='$uid' and paper_id='$paper_id'");
		Header("Location: index.php?type=papers");
	}
	else if($type='delinlist'){
		mysql_query("delete from user_bookmark_paper where user_id='$uid' and paper_id='$paper_id'");
		Header("Location: index.php?type=paperbookmarked");
	}
}

if($author_id!=null){
	if($type=='add'){
		mysql_query("insert into user_bookmark_author (user_id,author_id) values ('" . $uid . "', '".$author_id."');");
		Header("Location: index.php?type=authors");
	}
	else if($type=='del'){
		mysql_query("delete from user_bookmark_author where user_id='$uid' and author_id='$author_id'");
		Header("Location: index.php?type=authors");
	}
	else if($type='delinlist'){
		mysql_query("delete from user_bookmark_author where user_id='$uid' and author_id='$author_id'");
		Header("Location: index.php?type=authorbookmarked");
	}
}

?>