<?php
	$result_pn = mysql_query("SELECT count(*) FROM user_bookmark_paper WHERE user_id=".$_SESSION['uid']);
	$row = mysql_fetch_row($result_pn);
	$user_paper_n =$row[0];
	$result_pn = mysql_query("SELECT count(*) FROM user_bookmark_author WHERE user_id=".$_SESSION['uid']);
	$row = mysql_fetch_row($result_pn);
	$user_author_n =$row[0];
	$result_pn = mysql_query("SELECT count(*) FROM author");
	$row = mysql_fetch_row($result_pn);
	$author_n =$row[0];
	$result_pn = mysql_query("SELECT count(*) FROM paper");
	$row = mysql_fetch_row($result_pn);
	$paper_n =$row[0];
	$result_pn = mysql_query("SELECT count(*) FROM school");
	$row = mysql_fetch_row($result_pn);
	$school_n =$row[0];
?>