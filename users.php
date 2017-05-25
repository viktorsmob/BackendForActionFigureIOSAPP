<?php
 /**
 * index.php, home page.
 * @package Example-application
 */

require('./setup.php');
require_once('dbChannel.php');

require_once('dbUser.php');
$action="";
$user=null;
$user_id="";
$user_first_name="";
$user_last_name="";
$user_username="";
$user_email="";
$user_password="";
$user_conf_password="";
$mode="Add";
$selectedchannel="";
$selectedchannel_id="";
if(isset($_REQUEST['action']))
{
    $action = $_REQUEST['action'];
}
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
if($action == "user_info") //create new app
{
    //$user_id=$_REQUEST['id'];
	$user_username=$_REQUEST['username'];
	$user_email=$_REQUEST['email'];
	$user_password=$_REQUEST['password'];
	$user_conf_password=$_REQUEST['conf_password'];
	$mode=$_REQUEST['mode'];
    $channel_id=$_REQUEST['channel'];
	if($user_password!=$user_conf_password){
		echo "<script>alert('Invalid password!')</script>";
	}else{
		
	
	if($dbUser->checkUsername($user_username)||$dbUser->checkEmail($user_email)){
		echo "<script>alert('Invalid username or email')</script>";
	}else if($mode=='Add'){
		$dbUser->createUser( md5($user_username.$user_email),$user_username,$user_email,md5($user_password),$channel_id);
		
		$user_username="";
		$user_email="";
		$user_password="";
        $user_conf_password="";
	}
	if($mode=='Save'){
		$user_id=$_REQUEST['user_id'];
        $user=$dbUser->getUserById($user_id);
		$dbUser->saveUserById($user_id,$user['string_id'],$user_username,$user_email,$user_password);
		$mode="Add";
		
		$user_username="";
		$user_email="";
		$user_password="";
        $user_conf_password="";
	}
	}			
}else if($action=="mode"){
	$user_id=$_REQUEST['user_id'];
	$user=$dbUser->getUserById($user_id);
    
    $channel=$dbChannels->getChannelById($user['user_channel_id']);
	$user_username=$user['username'];
	$user_email=$user['email'];
	$user_password=$user['password'];
    $selectedchannel=$user['channel_name'];
	$selectedchannel_id=$user['user_channel_id'];
	$mode="Save";
}
if($action=="user_delete"){
	$user_id=$_REQUEST['user_id'];
	$dbUser->dropUserByID($user_id);
}
	
	$users=$dbUser->getUsers();
    $channels=$dbChannels->getChannels();
	$smarty->assign('user_id',$user_id);
	$smarty->assign('channels',$channels);
	$smarty->assign('username',$user_username);
	$smarty->assign('email',$user_email);
	$smarty->assign('password',$user_password);
	$smarty->assign('users',$users);
    $smarty->assign("selectedchannel",$selectedchannel);
    $smarty->assign("selectedchannel_id",$selectedchannel_id);
	$smarty->assign('mode',$mode);
	$smarty->display("{$prefix}users.tpl");
}else{
    $smarty->display("login.tpl");
}
?>