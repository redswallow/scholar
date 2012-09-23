<?php
require_once('../session.php');
require_once('../config.php');
require_once('../db.php');
if(!$login) header("location : ../index.php");


$result = mysql_query("SELECT username,pw FROM user WHERE id=".$uid);
$row = mysql_fetch_row($result);
$username = $row[0];$passwd = $row[1];

if (isset($_POST['edit_b'])){
	if(isset($_POST['username'])){
		if(md5($_POST['passwd']) != $passwd){
			echo "<h2>Please input right old password to edit the info</h2>";
			return;
		}
		if(isset($_POST['passwd_new']) && strlen($_POST['passwd_new']) > 0) $passwd = $_POST['passwd_new'];
		if(isset($_POST['username'])) $username = $_POST['username'];
		if(strlen($passwd) < 6){
			echo "<h2>Password must have more than 6 characters</h2>";
			return;
		}
		$result = mysql_query("update user set pw='" . md5($passwd) . "', username='" . $username . "' where id=" . $_SESSION['uid']);
		//if(isset($_POST['callback'])) Header("Location: " . $_POST['callback']);
		Header("Location: ../index.php");
		
	}
}
if (isset($_POST['return_b'])){
//	Header("Location: ../index.php");
}
?>
<span id="home_type">
	<a id="edituser_add" style="<?php if($home_type=='bookmarked') echo 'background:#E4EEF0'; ?>">Add</a>
	<a id="edituser_del" style="<?php if($home_type=='bookmarked') echo 'background:#E4EEF0'; ?>">Delete</a>
	<a id="edituser_change" style="<?php if($home_type=='bookmarked') echo 'background:#E4EEF0'; ?>">Edit</a>
</span>


<form id="add" action="adduser.php" method="post" style="width:100%;float:left;">
	<div style="float:left;width:100%;"><span>Username&nbsp;</span><input type="text" name="username" class="textinput" value=""/></div>
	<div style="float:left;width:100%;"><span>Password&nbsp;</span><input type="password" name="passwd" class="textinput" value=""/></div>
	<div style="float:left;width:100%;"><span>Group&nbsp;</span><input type="group" name="group" class="textinput" value=""/></div>
	<br />
	<input type="submit" value="Confirm" class="button" name="edit_b" />
	<input type="submit" value="Canceal" class="button" name="return_b" />
</form>

<form id="del" action="deluser.php" method="post" style="width:100%;float:left;">
	<div style="float:left;width:100%;"><span>Id&nbsp;</span><input type="text" name="id" class="textinput" value=""/></div>
	<input type="submit" value="Confirm" class="button" name="edit_b" />
	<input type="submit" value="Canceal" class="button" name="return_b" />
</form>

<form id="change" action="changeuser.php" method="post" style="width:100%;float:left;">
	<div style="float:left;width:100%;">
		<span>Id&nbsp;</span>
		<select name="id"> 
			<?php
				$result = mysql_query("select id from user");
				while($row=mysql_fetch_array($result,MYSQL_NUM)){
					echo "<option value='".$row[0]."'>".$row[0]."</option>";
				}
			?>
		</select> 
	</div><br />
	<div id="idconfirmed">
	<div style="float:left;width:100%;"><span>Username&nbsp;</span><input type="text" name="username" class="textinput" value=""/></div><br />
	<div style="float:left;width:100%;"><span>Password&nbsp;</span><input type="text" name="password" class="textinput" value=""/></div><br />
	<div style="float:left;width:100%;"><span>Group&nbsp;</span><input type="text" name="group" class="textinput" value=""/></div><br />
	</div>
	<div style="float:left;width:100%;">Note: Pls leave attrs empty if you don't want to change.</div>
	<input type="submit" value="Confirm" class="button" name="edit_b" />
	<input type="submit" value="Canceal" class="button" name="return_b" />
</form>

<?php
require_once "userstatus.php"
?>
		