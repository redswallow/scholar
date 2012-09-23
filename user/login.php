<?php
require_once('db.php');
$password = md5($_POST["password"]);
$username = $_POST["username"];

function IsUserExist($u){
        $result = mysql_query("select count(*) from user where username='$u'");
        if($result){
                $row = mysql_fetch_row($result);
                if($row[0] == 1) return TRUE;
        }
        return FALSE;
}

if(IsUserExist($username)){
        echo "exist username";
        $result = mysql_query("SELECT id,usergroup FROM user WHERE username='".$username."' and pw = '" . $password . "'");
        if ($result && mysql_num_rows($result) > 0){
			$row = mysql_fetch_row($result);
            $uid = $row[0];$usergroup=$row[1];
            echo $uid;
            session_start();
			$_SESSION["log"] = true;
			if ($usergroup == $ADMIN_USERGROUP)
				$_SESSION["admin"] = true;
			else $_SESSION["admin"] = false;
            $_SESSION["uid"] = $uid;
            if(isset($_POST['callback'])) Header("Location: " . $_POST['callback']);
            else Header("Location: index.php");
        } else {
                echo "Username and password error";
        }
}
else{
        if(strlen($_POST["password"]) < 6){
                echo "<h2>Password must exceed 6 characters</h2>";
                return;
        }
        echo "insert into user (username,pw,usergroup) values ('" . $username . "', '".$password."', '".$DEFAULT_USERGROUP."');";
        mysql_query("insert into user (username,pw,usergroup) values ('" . $username . "', '".$password."', '".$DEFAULT_USERGROUP."');");

        $result = mysql_query("SELECT id FROM user WHERE username='".$username."' and pw = '" . $password . "'");
        if ($result && mysql_num_rows($result) > 0) {
                $row = mysql_fetch_row($result);
                $uid = $row[0];
                session_start();
                $_SESSION["log"] = true;
				$_SESSION["admin"] = false;
                $_SESSION["uid"] = $uid;
		if(isset($_POST['callback'])) Header("Location: " . $_POST['callback']);
                else Header("Location: index.php");
        }
}
?>