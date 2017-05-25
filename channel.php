<?php
 /**
 * index.php, home page.
 * @package Example-application
 */

require('./setup.php');
require_once('dbChannel.php');
require_once('common.php');

$action="";
$mode="Add";
$coverimage="images/videoTitleIcon/videoicon.jpg";
$channel_name="";
$title_id='';
if(isset($_REQUEST['action']))
{
    $action = $_REQUEST['action'];
}
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $channels=$dbChannels->getChannels();
if($action == "create") 
{
    
	$title_id=$_REQUEST['title_id'];
	$mode=$_REQUEST['mode'];
	$channel_name=$_REQUEST['title'];
    $filename=uploadImage('imagefile','channelcoverimage',329,185,true);
    $coverimage=$filename;
    if($channel_name==''){
        echo"<script>alert('Enter Channel Name!');</script>";
    }else{
	if($mode=='Add'){
        if($filename==''){
       
           }else{
    
			$dbChannels->createChannel($channel_name,$coverimage);
            $channels=$dbChannels->getChannels();
	    
	        $coverimage="images/videoTitleIcon/videoicon.jpg";
	        $channel_name="";
           }
	}else if($mode=='Save'){
        $channel=$dbChannels->getChannelById($title_id);
        
          if($filename==''){
              $coverimage=$channel['coverimage'];
            
             }
        $dbChannels->saveChannelById($title_id,$channel_name,$coverimage);
        $channels=$dbChannels->getChannels();
        $coverimage="images/videoTitleIcon/videoicon.jpg";
	        $channel_name="";
                $mode="Add";
		
	}
    }
			
}else if($action=="modify"){

	$title_id=$_REQUEST['id'];
	$channel=$dbChannels->getChannelById($title_id);
    $channel_name=$channel['channel_name'];
    $coverimage=$channel['coverimage'];
   
	$mode="Save";
}
if($action=="delete"){
	$title_id=$_REQUEST['id'];
	
	$dbChannels->dropChannelByID($title_id);
    $channels=$dbChannels->getChannels();
    
}
    $smarty->assign("channels",$channels);
	$smarty->assign("mode",$mode);
    $smarty->assign("coverimage",$coverimage);
    $smarty->assign("channel_name",$channel_name);
    $smarty->assign('title_id',$title_id);
    
	$smarty->display("channel.tpl");
}else{
    $smarty->display("login.tpl");
}
?>