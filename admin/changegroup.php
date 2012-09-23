<?php
require_once('../db.php');
$id = $_POST["id"];
$checkbox = $_POST["checkbox"];
for($i=0;$i<4;$i++) $group[$i]=0;

if (isset($_POST['return_b'])){
	Header("Location: index.php?type=editgroup");
}
for($i=0;$i< count($checkbox);$i++)   
if ($checkbox[$i]!=null) $group[$checkbox[$i]]=1;
//echo $id;
//for($i=0;$i< count($group);$i++)  echo $group[$i];
mysql_query("update usergroup set bookmark='$group[0]' where id='$id'");
mysql_query("update usergroup set query='$group[1]' where id='$id'");
mysql_query("update usergroup set watch='$group[2]' where id='$id'");
mysql_query("update usergroup set admin='$group[3]' where id='$id'");
Header("Location: index.php?type=editgroup");
?>