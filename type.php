<?php
 /**
 * index.php, home page.
 * @package Example-application
 */

require('./setup.php');
require_once('dbType.php');
require_once('common.php');

$action="";
$mode="Add";

$type_name="";
$title_id='';
if(isset($_REQUEST['action']))
{
    $action = $_REQUEST['action'];
}
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $types=$dbTypes->getTypes();
if($action == "create") 
{
    
	$title_id=$_REQUEST['title_id'];
	$mode=$_REQUEST['mode'];
	$type_name=$_REQUEST['title'];
   
    if($type_name==''){
        echo"<script>alert('Enter Type Name!');</script>";
    }else{
	if($mode=='Add'){
       
    
			$dbTypes->createType($type_name);
            $types=$dbTypes->getTypes();
	    
	        
	        $type_name="";
           
	}else if($mode=='Save'){
        $type=$dbTypes->getTypeById($title_id);
        
          
        $dbTypes->saveTypeById($title_id,$type_name);
        $types=$dbTypes->getTypes();
        
	        $type_name="";
                $mode="Add";
		
	}
    }
			
}else if($action=="modify"){

	$title_id=$_REQUEST['id'];
	$type=$dbTypes->getTypeById($title_id);
    $type_name=$type['name'];
   
	$mode="Save";
}
if($action=="delete"){
	$title_id=$_REQUEST['id'];
	
	$dbTypes->dropTypeByID($title_id);
    $types=$dbTypes->getTypes();
    
}
    $smarty->assign("types",$types);
	$smarty->assign("mode",$mode);
    
    $smarty->assign("type_name",$type_name);
    $smarty->assign('title_id',$title_id);
    
	$smarty->display("type.tpl");
}else{
    $smarty->display("login.tpl");
}
?>