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

class dbCategory extends dbConn{
	function __construct() {
        parent::__construct(array());
    }
        
    public function getCategories() {
        $sql = "select * from  tbl_category";
        $categories = $this->fetchAll($sql);

        return $categories;
    }

	public function getCategoryById($id) {
        $sql = "SELECT * FROM tbl_category WHERE id=$id";
        $category = $this->fetchRow($sql);
        return $category;
    }
	
	public function createCategory($name,$coverimage)
	{
		$sql="INSERT INTO tbl_category (category_name,coverimage) 
		VALUES ('$name','$coverimage')";
        //print_r($sql);exit;
		$this->query($sql);
	}
	    
   	public function dropCategoryById($id)
	{
		$sql="DELETE FROM tbl_category WHERE id=$id";
		$this->query($sql);
	}
	
	public function saveCategoryById($id,$name,$coverimage) {
        $sql = "UPDATE tbl_category ";
        $sql.= "SET category_name='$name',coverimage='$coverimage'";
		$sql.= "WHERE id=$id";
        $this->query($sql);
    }
	
	
	
}

$dbCategories = new dbCategory();
?>
