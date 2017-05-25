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

class dbChannel extends dbConn{
	function __construct() {
        parent::__construct(array());
    }
        
    public function getChannels() {
        $sql = "select * from  tbl_channel";
        $channels = $this->fetchAll($sql);

        return $channels;
    }

	public function getChannelById($id) {
        $sql = "SELECT * FROM tbl_channel WHERE id=$id";
        $channel = $this->fetchRow($sql);
        return $channel;
    }
    public function getChannelsById($id) {
        $sql = "SELECT * FROM tbl_channel WHERE id=$id";
        $channel = $this->fetchAll($sql);
        return $channel;
    }
	
	public function createChannel($name,$coverimage)
	{
		$sql="INSERT INTO tbl_channel (channel_name,coverimage) 
		VALUES ('$name','$coverimage')";
		$this->query($sql);
	}
	    
   	public function dropChannelById($id)
	{
		$sql="DELETE FROM tbl_channel WHERE id=$id";
		$this->query($sql);
	}
	
	public function saveChannelById($id,$name,$coverimage) {
        $sql = "UPDATE tbl_channel ";
        $sql.= "SET channel_name='$name',coverimage='$coverimage'";
		$sql.= "WHERE id=$id";
        $this->query($sql);
    }
	
	public function saveViewCountById($channel_id,$channel_view_count) {
        $sql = "UPDATE tbl_channel ";
        $sql.= "SET channel_view_count='$channel_view_count'";
		$sql.= "WHERE id=$channel_id";
        $this->query($sql);
    }
	
}

$dbChannels = new dbChannel();
?>
