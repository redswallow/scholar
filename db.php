<?php
require_once('config.php');
 // �����ݿ�����
$db_connection = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);

if (!$db_connection) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db(DB_NAME);
?>