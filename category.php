<?php
 /**
 * index.php, home page.
 * @package Example-application
 */

require('./setup.php');
require_once('dbCategory.php');
require_once('common.php');

$action="";
$mode="Add";
$coverimage="images/videoTitleIcon/videoicon.jpg";
$category_name="";
$title_id='';
if(isset($_REQUEST['action']))
{
    $action = $_REQUEST['action'];
}
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $categories=$dbCategories->getCategories();
if($action == "create") 
{
    
	$title_id=$_REQUEST['title_id'];
	$mode=$_REQUEST['mode'];
	$category_name=$_REQUEST['title'];
    $filename=uploadImage('imagefile','categorycoverimage',329,185,true);
    $coverimage=$filename;
    if($category_name==''){
        echo"<script>alert('Enter Category Name!');</script>";
    }else{	if($mode=='Add'){
        if($filename==''){
       
           }else{
    
			$dbCategories->createCategory($category_name,$coverimage);
            $categories=$dbCategories->getCategories();
	    
	        $coverimage="images/videoTitleIcon/videoicon.jpg";
	        $category_name="";
           }
	}else if($mode=='Save'){
        $category=$dbCategories->getCategoryById($title_id);
        
          if($filename==''){
              $coverimage=$category['coverimage'];
            
             }
        $dbCategories->saveCategoryById($title_id,$category_name,$coverimage);
        $categories=$dbCategories->getCategories();
        $coverimage="images/videoTitleIcon/videoicon.jpg";
	        $category_name="";
                $mode="Add";
		
	}
}		
}else if($action=="modify"){

	$title_id=$_REQUEST['id'];
	$category=$dbCategories->getCategoryById($title_id);
    $category_name=$category['category_name'];
    $coverimage=$category['coverimage'];
   
	$mode="Save";
}
if($action=="delete"){
	$title_id=$_REQUEST['id'];
	
	$dbCategories->dropCategoryByID($title_id);
    $categories=$dbCategories->getCategories();
    
}
    $smarty->assign("categories",$categories);
	$smarty->assign("mode",$mode);
    $smarty->assign("coverimage",$coverimage);
    $smarty->assign("category_name",$category_name);
    $smarty->assign('title_id',$title_id);
    
	$smarty->display("category.tpl");
}else{
    $smarty->display("login.tpl");
}
?>