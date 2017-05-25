<?php
 /**
 * index.php, home page.
 * @package Example-application
 */
error_reporting(0);
require('./setup.php');

$smarty->display("{$prefix}login.tpl");

?>