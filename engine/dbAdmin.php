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

class dbAdmin extends dbConn{
	function __construct() {
        parent::__construct(array());
    }
    
    public function createAdmin($username,$pass){
        	
        $sql = "INSERT INTO tbl_admin 	(username,password) ";
        $sql.= "VALUES 				('$username','$pass')";
       // print_r($sql);exit;
        $this->query($sql);
     }
   
    public function dropAdminById($id) {
    	
//
            $sql = "DELETE FROM tbl_admin WHERE admin_id=$id";
            $this->query($sql);
    }
	
	public function getAdmins()
	{
		$sql="SELECT * FROM tbl_admin ";
       // print_r($sql);exit;
		$users=$this->fetchAll($sql);
        
		return $users;
	}

    public function getAdminById($id) {
        $sql = "SELECT * FROM tbl_admin WHERE admin_id=$id";
        $user = $this->fetchRow($sql);
        return $user;
    }
   
     public function getAdminByUsername($username) {
       $sql = "SELECT * FROM tbl_admin WHERE username='$username'";
       // print_r($sql);exit;
        $user = $this->fetchRow($sql);
       // print_r($user['username']);exit;
        return $user;
    }
    
     public function saveUserById($id,$username,$password) {
        $sql = "UPDATE tbl_admin "	;   
        $sql.= "SET username='$username',password='$password'";
        $sql.= "WHERE id=$id";
        $this->query($sql);
    }
    
    public function checkAdminname($username)
    {
    	$sql = "select * from tbl_admin where adminname='$username'";
    	$res = $this->fetchRow($sql);
    	return $res;
    }
    
    public function checkUserWithPassword($username, $password)
    {
    	$sql = "select * from tbl_admin where username='$username' and password='$password' ";
    	$res = $this->fetchRow($sql);
    	if($res) {
           // if($res['password']==$password)
    		   		
				return $res;
        }else
        return null;
          
    	    	
    }
    
    
    public function userNameExist($username)
    {
		$sql = "select user_id from tbl_admin where username='" . $username . "'";
		$res = $this->fetchAll($sql);
	    	if(count($res) > 0)
	    	{
	    		return true;
	    	}
	    	return false;
    }
    
	

}

$dbAdmin = new dbAdmin();

?>
