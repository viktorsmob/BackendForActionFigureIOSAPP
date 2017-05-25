<?php
 /**
 * index.php, home page.
 * @package Example-application
 */
require('./setup.php');
require_once('dbAdmin.php');
require_once('dbChannel.php');

$action="";

$mode="Add";
$selectedchannel_id="";
$selelctedchannel="";
$channels="";
$adminname="";
if(isset($_REQUEST['action']))
{
    $action = $_REQUEST['action'];
}
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true&&$_SESSION['username']=='admin') {
    
if($action == "create") //create new app
{
    //$user_id=$_REQUEST['id'];
	$adminname=$_REQUEST['adminname'];
	
    $password=$_REQUEST['password'];
	$conf_password=$_REQUEST['conf_password'];
	$mode=$_REQUEST['mode'];
	if($password!=$conf_password){
		echo "<script>alert('Invalid password!')</script>";
	}elseif($dbAdmin->checkAdminname($adminname)){
		echo "<script>alert('Invalid username or email')</script>";
	}else if($adminname==""){
		echo "<script>alert('Please type admin name!')</script>";
		
	}else {
        $dbAdmin->createAdmin($adminname,md5($password));
        
    }  
}
    
  if($action=="delete"){
	$id=$_REQUEST['id'];
	$dbAdmin->dropAdminByID($id);
    }
    $admins=$dbAdmin->getAdmins();
    
	
	$smarty->assign('admins',$admins);
   	
	
	$smarty->assign('mode',$mode);
	$smarty->display("{$prefix}admin.tpl");
	
}else{
    $smarty->display("login.tpl");
}

?>