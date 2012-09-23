<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once "config.php";
require_once "header.php";

include "query.php";
include "view.php";

echo <<<EOT
</body>
</html>
EOT;
?>