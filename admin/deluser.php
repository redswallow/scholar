<?php
require_once('../db.php');
$id = $_POST["id"];

function IsIdExist($u){
        $result = mysql_query("select count(*) from user where id='$u'");
        if($result){
                $row = mysql_fetch_row($result);
                if($row[0] == 1) return TRUE;
        }
        return FALSE;
}
if (isset($_POST['return_b'])){
	Header("Location: index.php?type=edituser");
}
if(IsIdExist($id)){
    mysql_query("delete from user where id='$id'");
	Header("Location: index.php?type=edituser");
}
else{
	echo "<h2>Id not exist!</h2>";
}
?>