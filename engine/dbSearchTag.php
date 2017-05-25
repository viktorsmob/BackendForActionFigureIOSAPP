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

class dbSearchTag extends dbConn{
	function __construct() {
        parent::__construct(array());
    }
    
    public function createSearchTag($video_id,$tag_name){
        	
        $sql = "INSERT INTO tbl_search_tag 	(video_id,tag_name) ";
        $sql.= "VALUES 				('$video_id','$tag_name')";
		//print_r($sql);exit;
        $this->query($sql);
     }
     public function createSearchTagUser($video_id,$tag_name,$user_id){
        	
        $sql = "INSERT INTO tbl_search_tag 	(video_id,tag_name,user_id) ";
        $sql.= "VALUES 				('$video_id','$tag_name','$user_id')";
		//print_r($sql);exit;
        $this->query($sql);
     }
   public function saveSearchTagById($id,$video_id,$tag_name){
       $sql = "UPDATE tbl_search_tag "	;   
        $sql.= "SET video_id='$video_id',tag_name='$tag_name'";
        $sql.= "WHERE id='$id'";
       //print_r($sql);exit;
        $this->query($sql);
   }
    public function dropSearchTagByID($id) {
    	

            $sql = "DELETE FROM tbl_search_tag WHERE tbl_search_tag.id=$id";
            //print_r($sql);exit;
            $this->query($sql);
    }
	
	

    public function getSearchTags() {
        $sql = "SELECT tbl_search_tag.*, tbl_video.title FROM  tbl_search_tag join tbl_video on tbl_video.id=tbl_search_tag.video_id ";
       
        $tags = $this->fetchAll($sql);
        return $tags;
    }
    public function getSearchTagsByUserId($user_id) {
        $sql = "SELECT tbl_search_tag.*, tbl_video.title FROM  tbl_search_tag join tbl_video on tbl_video.id=tbl_search_tag.video_id where  tbl_search_tag.user_id='$user_id' ";
       
        $tags = $this->fetchAll($sql);
        return $tags;
    }
    public function getSearchTagsByVideoId($video_id) {
        $sql = "SELECT * FROM  tbl_search_tag join tbl_video on tbl_video.id=tbl_search_tag.video_id  WHERE video_id='$video_id' ";
        
        $tags = $this->fetchAll($sql);
        return $tags;
    }
      public function getSearchTagById($id) {
        $sql = "SELECT tbl_search_tag.*, tbl_video.title FROM  tbl_search_tag join tbl_video on tbl_video.id=tbl_search_tag.video_id WHERE tbl_search_tag.id='$id' ";
        //print_r($sql);exit;
        $tag = $this->fetchRow($sql);
        return $tag;
    }
   
    
   

}

$dbSearchTags = new dbSearchTag();

?>
