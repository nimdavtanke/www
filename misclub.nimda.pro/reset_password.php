<?php
echo "123123<br />";
error_reporting(E_ALL);
echo "3222<br />":
require("functions/main.func.php");
 error_reporting(E_ALL);
$q = "UPDATE users SET password='" . md5('pmis1388') "' WHERE id='2'";
echo "$q<br/>";
if (doquery($q)) echo "Изменено!";
?>