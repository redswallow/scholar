<?php
$uid=$_SESSION['uid'];
$result=mysql_query("SELECT * FROM usergroup where id in (select usergroup from user where id='$uid')");
while($row=mysql_fetch_array($result,MYSQL_NUM)){
	$groupid=$row[0];$bookmark_right=$row[1];$search_right=$row[2];$watch_right=$row[3];$admin_right=$row[4];
	//echo $groupid,$bookmark_right,$search_right,$watch_right,$admin_right;
}
?>