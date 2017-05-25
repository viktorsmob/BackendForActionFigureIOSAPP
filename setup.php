<?php

mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');
session_start();
//ob_start("mb_output_handler");

$sitelang = "en";
$usertype_login="";
$userid_login=0;
define('ROOT_DIR' , dirname(__FILE__));

define("TEMPLATE_PATH",	 	ROOT_DIR . DIRECTORY_SEPARATOR . 'templates' 	. DIRECTORY_SEPARATOR);
define("TEMPLATE_C_PATH", 	ROOT_DIR . DIRECTORY_SEPARATOR . 'templates_c' 	. DIRECTORY_SEPARATOR);
define("CONFIG_PATH",	 	ROOT_DIR . DIRECTORY_SEPARATOR . 'configs' 		. DIRECTORY_SEPARATOR);
define("CACHE_PATH",	 	ROOT_DIR . DIRECTORY_SEPARATOR . 'cache' 		. DIRECTORY_SEPARATOR);
define('ENGINE_PATH', 		ROOT_DIR . DIRECTORY_SEPARATOR . 'engine' 		. DIRECTORY_SEPARATOR);
define('S3UPLOAD_PATH', 	ROOT_DIR . DIRECTORY_SEPARATOR . 's3upload' 	. DIRECTORY_SEPARATOR);
define('SMARTY_PATH', 		ROOT_DIR . DIRECTORY_SEPARATOR . 'libs' 		. DIRECTORY_SEPARATOR . 'Smarty-3.1.11' . DIRECTORY_SEPARATOR);

set_include_path(ENGINE_PATH . PATH_SEPARATOR . get_include_path());
set_include_path(SMARTY_PATH . PATH_SEPARATOR . get_include_path());

// Load Smarty
require('Smarty.class.php');

// Create a Smarty Instance
$smarty = new Smarty;

// Smarty Variables
//$smarty->force_compile = true;
$smarty->debugging = false;
$smarty->caching = true;
$smarty->force_compile = true;  //Recommend set it to false when the site is published
$smarty->cache_lifetime = 120;

// Smarty Folder Setting
$smarty->setTemplateDir(TEMPLATE_PATH);
$smarty->setCompileDir(TEMPLATE_C_PATH);
$smarty->setConfigDir(CONFIG_PATH);
$smarty->setCacheDir(CACHE_PATH);

// Load setting file.
require_once('setting.php');

?>
