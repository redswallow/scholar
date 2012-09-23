<?php
session_start();
unset($_SESSION['admin']);
unset($_SESSION['uid']);
unset($_SESSION['log']);
Header("Location: index.php");
?>