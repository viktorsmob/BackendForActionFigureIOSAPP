<?php 
/**
 * api.php, home page.
 * @package Example-application
 */
require('./setup.php');
require_once('common.php');
require_once('dbUser.php');
require_once('dbVideos.php');
require_once('dbCategory.php');
require_once('dbChannel.php');
require_once('dbType.php');
require_once('dbSearchTag.php');
require_once('common.php');
$action = "";
$date=date("Y-m-d h:i:s ");
$user_id = 1;
if(isset($_REQUEST['action']))
{
    $action = $_REQUEST['action'];
}

$code=200;
$message="Get video list info successfully";
/////////////////////////////////////
$categories=$dbCategories->getCategories();
$category_array=array();
foreach($categories as $k=>$category){
        $temp=array();
		$temp['id']=$category['id'];
		$temp['name']=$category['category_name'];
		$temp['coverimage']=$category['coverimage'];
        array_push($category_array,$temp);
          
}
////////////////////////////////////////
$channel_array=array();
$channels=$dbChannels->getChannels();
foreach($channels as $k=>$channel){
        $temp=array();
		$temp['id']=$channel['id'];
		$temp['name']=$channel['channel_name'];
		$temp['coverimage']=$channel['coverimage'];
        array_push($channel_array,$temp);
          
}
///////////////////////////////////////
$videos=$dbVideos->getVideos();
$video_array=array();
foreach($videos as $k=>$video){
        $temp=array();
		$temp['id']=$video['id'];
		$temp['title']=$video['title'];
        $temp['desc']=$video['description'];
		$temp['coverimage']=$video['coverimage'];
        $temp['videourl']=$video['video_url'];
        $temp['kind']=$video['kind'];
        $temp['type']=$video['name'];
        $searchtagsbyvideoid=$dbSearchTags->getSearchTagsByVideoId($video['id']);
        $searchtags_array=array();
        foreach($searchtagsbyvideoid as $k=>$tag){
            $temp_tags=array();
            $temp_tags['id']=$tag['id'];
             $temp_tags['tagname']=$tag['tag_name'];
             array_push($searchtags_array,$temp_tags);
        }
        $temp['searchtag']=$searchtags_array;
         $temp['categoryid']=$video['category_id'];
         $temp['channelid']=$video['channel_id'];
         $temp['categoryname']=$video['category_name'];
         $temp['channelname']=$video['channel_name'];
         
        array_push($video_array,$temp);
}
////////////////////////////////////////////////////
$data['categories']=$category_array;
$data['channel']=$channel_array;
$data['videos']=$video_array;
//////////////////////////////////////////////////
$response['code']=$code;
$response['message']=$message;
$response['data']=$data;
//////////////////////////////////////////////////

print_r(json_encode($response));
return json_encode($response);

?>


