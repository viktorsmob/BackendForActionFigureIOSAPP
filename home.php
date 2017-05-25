<?php
 /**
 * index.php, home page.
 * @package Example-application
 */

require('./setup.php');
//require_once('dbUser.php');

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

$smarty->display("{$prefix}homepage.tpl");
}else{
    $smarty->display("{$prefix}login.tpl");
}

?>