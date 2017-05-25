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

class dbType extends dbConn{
	function __construct() {
        parent::__construct(array());
    }
    
    public function createType($name){
        	
        $sql = "INSERT INTO tbl_type 	(name) ";
        $sql.= "VALUES 				('$name')";		
        $this->query($sql);
     }
   
    public function dropTypeById($id) {
    	
            
            $sql = "DELETE FROM tbl_type WHERE id=$id";
            $this->query($sql);
    }
	
	public function getTypes()
	{  
        
        
		$sql="SELECT * FROM tbl_type ";
		$types=$this->fetchAll($sql);
        //print_r($user_points);
		return $types;
	}
    // public function sortPoints(){
    //     $sql_sort="SELECT *FROM tbl_user_points ORDER BY total_points DESC";
    //     //print_r($sql_sort);
    //     $this->query($sql_sort);
    // }

    public function getTypeById($id) {
        $sql = "SELECT * FROM  tbl_type  WHERE id=$id";
        $type = $this->fetchRow($sql);
        return $type;
    }
   
       
     public function saveTypeById($id,$name) {
        $sql = "UPDATE tbl_type "	;   
        $sql.= "SET name='$name'";
        $sql.= "WHERE id=$id";
        $this->query($sql);
    }
    
    public function saveCheckedById($id) {
        $sql = "UPDATE tbl_type "	;   
        $sql.= "SET checked='checked'";
        $sql.= "WHERE id=$id";
        $this->query($sql);
    }
   

}

$dbTypes = new dbType();

?>
