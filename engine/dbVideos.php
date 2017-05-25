<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * User DB management class
 *
 * @package hanapub
 */

require_once 'dbConn.php';

class dbVideos extends dbConn{
	function __construct() {
        parent::__construct(array());
    }
    
   public function createVideo($title,$description,$coverimage,$type_id,$category_id,$channel_id,$video_url,$view_count,$kind) {
    	
        $sql = "INSERT INTO tbl_video 	(title,description,coverimage,type_id,category_id,channel_id,video_url,view_count,kind) ";
        $sql.= "VALUES 	('$title','$description','$coverimage','$type_id','$category_id','$channel_id','$video_url','$view_count','$kind')";
       //print_r($sql);exit;
        $this->query($sql);
    }
    public function createVideo_user($title,$description,$coverimage,$type_id,$category_id,$channel_id,$video_url,$view_count,$user_id,$kind) {
    	
        $sql = "INSERT INTO tbl_video 	(title,description,coverimage,type_id,category_id,channel_id,video_url,view_count,user_id,kind) ";
        $sql.= "VALUES 	('$title','$description','$coverimage','$type_id','$category_id','$channel_id','$video_url','$view_count','$user_id','$kind')";
       //print_r($sql);exit;
        $this->query($sql);
    }
    public function dropVideoById($id) {
    	global $adminLevel;

            $sql = "DELETE FROM tbl_video WHERE id=$id";
            $this->query($sql);
    }
	
	public function getVideos()
	{
		$sql="SELECT tbl_video.*, tbl_type.name, tbl_category.category_name, tbl_channel.channel_name FROM tbl_video  join tbl_type on tbl_video.type_id=tbl_type.id
         join tbl_category on tbl_video.category_id=tbl_category.id join tbl_channel on tbl_video.channel_id=tbl_channel.id order by `upload_date` desc ";
	    //print_r($sql);exit;
        $videos=$this->fetchAll($sql);
		return $videos;
	}

    public function getVideoById($id) {
        $sql="SELECT tbl_video.*, tbl_type.name, tbl_category.category_name, tbl_channel.channel_name FROM tbl_video join tbl_type on tbl_video.type_id=tbl_type.id
         join tbl_category on tbl_video.category_id=tbl_category.id join tbl_channel on tbl_video.channel_id=tbl_channel.id WHERE tbl_video.id=$id";

        $video = $this->fetchRow($sql);
        return $video;
    }
    public function getVideosByCategoryId($id) {
        $sql="SELECT tbl_video.*, tbl_type.name, tbl_category.category_name, tbl_channel.channel_name FROM tbl_video join tbl_type on tbl_video.type_id=tbl_type.id
         join tbl_category on tbl_video.category_id=tbl_category.id join tbl_channel on tbl_video.channel_id=tbl_channel.id WHERE tbl_video.category_id=$id";
        $videos = $this->fetchAll($sql);
        return $videos;
    }
    
     public function getVideosByChannelId($id) {
         $sql="SELECT tbl_video.*, tbl_type.name, tbl_category.category_name, tbl_channel.channel_name FROM tbl_video join tbl_type on tbl_video.type_id=tbl_type.id
         join tbl_category on tbl_video.category_id=tbl_category.id join tbl_channel on tbl_video.channel_id=tbl_channel.id WHERE tbl_video.channel_id=$id";
        $videos = $this->fetchAll($sql);
        return $videos;
    }
     public function getVideosByUserId($id) {
         $sql="SELECT tbl_video.*, tbl_type.name, tbl_category.category_name, tbl_channel.channel_name FROM tbl_video join tbl_type on tbl_video.type_id=tbl_type.id
         join tbl_category on tbl_video.category_id=tbl_category.id join tbl_channel on tbl_video.channel_id=tbl_channel.id join tbl_user on tbl_user.user_id=tbl_video.user_id WHERE tbl_video.user_id=$id";
       //print_r($sql);exit;
        $videos = $this->fetchAll($sql);
        return $videos;
    }
    public function saveVideoById($id,$title,$description,$coverimage,$type_id,$category_id,$channel_id,$video_url,$view_count,$kind){
        $sql = "UPDATE tbl_video ";
        $sql.= "SET title='$title',category_id='$category_id',channel_id='$channel_id',
		type_id='$type_id',video_url='$video_url',description='$description',
        coverimage='$coverimage',view_count='$view_count',kind='$kind'";
        $sql.= "WHERE id=$id";
        
        $this->query($sql);
    }
    public function  saveViewCountById($id,$view_count){
         $sql = "UPDATE tbl_video ";
        $sql.= "SET view_count='$view_count'";
        $sql.= "WHERE id=$id";
        $this->query($sql);
        
    }
    
   public function getChannelIdByVideoId($id) {
         $sql="SELECT tbl_video.channel_id FROM tbl_video WHERE tbl_video.id=$id";
        $channel_id = $this->fetchAll($sql);
        return $channel_id;
    }

}

$dbVideos = new dbVideos();
?>
