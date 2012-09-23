<?php
$login = FALSE;
$uid = -1;
if (isset($_SESSION["log"]) && $_SESSION["log"] === true){
	$login = TRUE;
	if(isset($_SESSION["uid"]))
		$uid = $_SESSION["uid"];
}
if($uid < 0) $login = FALSE;
?>