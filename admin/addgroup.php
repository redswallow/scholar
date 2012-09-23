<?php
require_once('../db.php');
$checkbox = ($_POST["checkbox"]);
for($i=0;$i<4;$i++) $group[$i]=0;

if (isset($_POST['return_b'])){
	Header("Location: index.php?type=editgroup");
}
for($i=0;$i< count($checkbox);$i++)   
if ($checkbox[$i]!=null) $group[$checkbox[$i]]=1;

//for($i=0;$i< count($group);$i++)  echo $group[$i];
mysql_query("insert into usergroup (bookmark,query,watch,admin) values ('" . $group[0] . "', '".$group[1]."', '".$group[2]."', '".$group[3]."');");
Header("Location: index.php?type=editgroup");
?>