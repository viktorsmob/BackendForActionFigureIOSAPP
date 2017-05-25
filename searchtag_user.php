<?php
 /**
 * index.php, home page.
 * @package Example-application
 */

require('./setup.php');
require_once('dbSearchTag.php');
require_once('dbVideos.php');

require_once('common.php');

		$action = "";
		$mode="0";
		$title_id="0";
		$selectedvideo_id="";
		$selectedvideo="";
		$tag_name="";
		
if(isset($_REQUEST['action']))
{
    $action = $_REQUEST['action'];
}

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
$user_id=$_SESSION['user_id'];
$searchtags=$dbSearchTags->getSearchTagsByUserId($user_id);

$videos=$dbVideos->getVideosByUserId($user_id);
if($action=='create'){
	$mode=$_REQUEST['mode'];
	//print_r($mode);exit;
	$video_id=$_REQUEST['video'];
	$tag_name=$_REQUEST['searchtag'];
	$id=$_REQUEST['title_id'];
		
	if($mode=='0'){
		
	$dbSearchTags->createSearchTagUser($video_id,$tag_name,$user_id) ;
   
	$searchtags=$dbSearchTags->getSearchTagsByUserId($user_id);
	$tag_name="";
	}
	else{
		$mode='0';      
	$dbSearchTags->saveSearchTagById($id,$video_id,$tag_name);
	$searchtags=$dbSearchTags->getSearchTagsByUserId($user_id);
    $tag_name="";
	
	}
	
//$smarty->display("{$prefix}videoTitle.tpl");
	
		
}
if($action=='delete'){
	$title_id=$_REQUEST['id'];
	$dbSearchTags->dropSearchTagById($title_id);
	$searchtags=$dbSearchTags->getSearchTagsByUserId($user_id);
		
}
if($action=='modify'){
	$title_id=$_REQUEST['id'];
	$searchtag=$dbSearchTags->getSearchTagById($title_id);
    //print_r($video);exit;
	//print_r($searchtag);exit;
	$selectedvideo_id=$searchtag['video_id'];
	$selectedvideo=$searchtag['title'];
	$mode='1';
	$tag_name=$searchtag['tag_name'];
	
	
		
}
	
	
	$smarty->assign("mode",$mode);
    $smarty->assign("title_id",$title_id);
    $smarty->assign("tag_name",$tag_name);
    $smarty->assign("selectedvideo_id",$selectedvideo_id);
    $smarty->assign("selectedvideo",$selectedvideo);
    $smarty->assign("searchtags",$searchtags);
    $smarty->assign("videos",$videos);
    
    
	$smarty->display("{$prefix}searchtag_user.tpl");
} else {
   $smarty->display("{$prefix}login.tpl");
}

?>