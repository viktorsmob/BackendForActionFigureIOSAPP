<?php
 /**
 * Home page

 * @package Example-application
 */

require('./setup.php');
require_once('common.php');
require_once('dbAdmin.php');
require_once('dbUser.php');


$action="";
if(isset($_REQUEST['action']))
{
    $action = $_REQUEST['action'];
}

if($action=="login"){
$username=$_REQUEST['username'];
$password=$_REQUEST['password'];

$result_admin=$dbAdmin->checkUserWithPassword($username, md5($password));

$result_user=$dbUser->getUserWithPassword($username, md5($password));
$user_id='';

if($result_admin){
	
		
		$_SESSION['loggedin'] = true;
		$_SESSION['username'] = $username;
		
		$smarty->display("homepage.tpl");
        exit;
}else if($result_user){
        $_SESSION['loggedin'] = true;
		$_SESSION['username'] = $username;
		$user=$dbUser->getUserByUsername($username);
        $user_id=$user['user_id'];
        $_SESSION['user_id']=$user_id;
        $_SESSION['channel_id']=$user['user_channel_id'];
        $_SESSION['channel_name']=$user['channel_name'];
		$smarty->display("homepage_user.tpl");
        exit;
}else{
    echo"<script>alert('Invalid User!');</script>"; 
	$smarty->display("{$prefix}login.tpl");
}

}


?>