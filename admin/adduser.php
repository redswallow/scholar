<?php
require_once('../db.php');
$password = md5($_POST["passwd"]);
$username = $_POST["username"];
$group = $_POST["group"];

function IsUserExist($u){
        $result = mysql_query("select count(*) from user where username='$u'");
        if($result){
                $row = mysql_fetch_row($result);
                if($row[0] == 1) return TRUE;
        }
        return FALSE;
}
function IsGroupExist($u){
        $result = mysql_query("select count(*) from usergroup where id='$u'");
        if($result){
                $row = mysql_fetch_row($result);
                if($row[0] == 1) return TRUE;
        }
        return FALSE;
}

if (isset($_POST['return_b'])){
	Header("Location: index.php?type=edituser");
}

if(IsUserExist($username)){
        echo "<h2>exist username</h2>";
}
else{
        if(strlen($_POST["passwd"]) < 6){
                echo "<h2>Password must exceed 6 characters</h2>";
                return;
        }
		if (IsGroupExist($group)==False){
		        echo "<h2>Group not exist!</h2>";
                return;
		}
        echo "insert into user (username,pw,usergroup) values ('" . $username . "', '".$password."', '".$group."');";
        mysql_query("insert into user (username,pw,usergroup) values ('" . $username . "', '".$password."', '".$group."');");

		Header("Location: index.php?type=edituser");
}
?>