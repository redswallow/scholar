<h3>Please login/signup : </h3>
<form action="./login.php" method="post" style="width:100%;float:left;">
	<div style="float:left;width:100%;"><span>Username&nbsp;</span><input type="text" name="username" class="textinput" value=""/></div>
	<div style="float:left;width:100%;"><span>Password&nbsp;</span><input type="password" name="password" class="textinput" value=""/></div>
	<input type="hidden" name="callback" value="<?php echo "http://".$_SERVER ['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" />
	<input type="submit" value="Login/Signup" class="button" />
</form>