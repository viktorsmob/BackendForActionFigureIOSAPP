<?php 
/**
 * api.php, home page.
 * @package Example-application
 */
require('./setup.php');

require_once('dbVideos.php');
require_once('dbChannel.php');

require_once('common.php');
$action = "";
$date=date("Y-m-d h:i:s ");
$user_id = 1;
if(isset($_REQUEST['action']))
{
    $action = $_REQUEST['action'];
}

$video_id=$_REQUEST['video_id'];
$video=$dbVideos->getVideoById($video_id);
$view_count=$video['view_count']+1;
$dbVideos->saveViewCountById($video_id,$view_count);


$channel_id=$video['channel_id'];

$channel=$dbChannels->getChannelById($channel_id);
$channel_view_count=$channel['channel_view_count']+1;
$dbChannels->saveViewCountById($channel_id,$channel_view_count);


?>


