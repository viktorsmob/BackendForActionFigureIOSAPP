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

class dbUser extends dbConn{
	function __construct() {
        parent::__construct(array());
    }
    
    public function createUser($string_id,$username,$email,$pass,$channel_id){
        	
        $sql = "INSERT INTO tbl_user 	(string_id,username,email,password,user_channel_id) ";
        $sql.= "VALUES 				('$string_id','$username','$email','$pass','$channel_id')";
     
        $this->query($sql);
     }
   
    public function dropUserById($id) {
    	
//
            $sql = "DELETE FROM tbl_user WHERE user_id=$id";
            $this->query($sql);
    }
	
	public function getUsers()
	{
		$sql="SELECT * FROM tbl_user join tbl_channel on tbl_channel.id=tbl_user.user_channel_id";
        
		$users=$this->fetchAll($sql);
		return $users;
	}

    public function getUserById($id) {
        $sql = "SELECT * FROM tbl_user join tbl_channel on tbl_channel.id=tbl_user.user_channel_id WHERE user_id=$id";
        //print_r($sql);exit;
        $user = $this->fetchRow($sql);
        return $user;
    }
   
     public function getUserByUsername($username) {
       $sql = "SELECT * FROM tbl_user join tbl_channel on tbl_channel.id=tbl_user.user_channel_id WHERE username='$username'";
       // print_r($sql);exit;
        $user = $this->fetchRow($sql);
       // print_r($user['username']);exit;
        return $user;
    }
    
     public function saveUserById($id,$string_id,$username,$email,$password) {
        $sql = "UPDATE tbl_user "	;   
        $sql.= "SET string_id='$string_id',username='$username',email='$email', password='$password',email='$email'";
        $sql.= "WHERE user_id=$id";
        $this->query($sql);
    }
    
    public function checkUsername($username)
    {
    	$sql = "select * from tbl_user where username='$username'";
    	$res = $this->fetchRow($sql);
    	return $res;
    }
    
    public function getUserWithPassword($username)
    {
    	$sql = "select * from tbl_user where username='$username'";
    
    	$res = $this->fetchRow($sql);
       
    	if($res) {
           // if($res['password']==$password)
    		   		
				return $res;
        }else
        {
             return null;
        }
       
          
    	    	
    }
    
    
    public function userNameExist($username)
    {
		$sql = "select user_id from tbl_user where username='" . $username . "'";
		$res = $this->fetchAll($sql);
	    	if(count($res) > 0)
	    	{
	    		return true;
	    	}
	    	return false;
    }
    
	public function checkEmail($email)
	{
		$sql="select user_id from tbl_user where email='".$email."'";
		$res=$this->fetchAll($sql);
		if(count($res)>0)
			return true;
		return false;
	}

}

$dbUser = new dbUser();

?>
