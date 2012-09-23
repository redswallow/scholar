<?php
require_once('../db.php');
$id = $_POST["id"];
$password = md5($_POST["password"]);
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
		$result = mysql_query("select * from user where id='$id'");
		if($result){
                $row=mysql_fetch_array($result,MYSQL_NUM);
                if($username==null) $username=$row[1];
				if($password==md5(null)) $password=$row[2];
				if($group==null) $group=$row[3];
        }
        if($_POST["password"]!=null and strlen($_POST["password"]) < 6){
                echo "<h2>Password must exceed 6 characters</h2>";
                return;
        }
		if ($group!=null and IsGroupExist($group)==False){
		        echo "<h2>Group not exist!</h2>";
                return;
		}
		
        mysql_query("update user set username='$username' where id='$id'");
		mysql_query("update user set pw='$password' where id='$id'");
		mysql_query("update user set usergroup='$group' where id='$id'");

		Header("Location: index.php?type=edituser");
}
?>