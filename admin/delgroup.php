<?php
require_once('../db.php');
$id = $_POST["id"];

function IsIdExist($u){
        $result = mysql_query("select count(*) from usergroup where id='$u'");
        if($result){
                $row = mysql_fetch_row($result);
                if($row[0] == 1) return TRUE;
        }
        return FALSE;
}
if (isset($_POST['return_b'])){
	Header("Location: index.php?type=editgroup");
}
if(IsIdExist($id)){
    mysql_query("delete from usergroup where id='$id'");
	Header("Location: index.php?type=editgroup");
}
else{
	echo "<h2>GroupId not exist!</h2>";
}
?>