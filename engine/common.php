<?php
 /**
 * 
 *
 * @package hanapub
 */


require_once('dbUser.php');
 require_once('aws-sdk-php-master/vendor/autoload.php');



// require_once('aws-sdk-php-master/vendor/aws/aws-sdk-php/src/S3/UploadBuilder.php');
use Aws\S3\S3Client;
use Aws\S3\MultipartUploader;
use Aws\Exception\MultipartUploadException;


function getUniqueFileName() {
    return strval(time());
}


function uploadVideos($filetag){
    
    $name = $_FILES[$filetag]['name'];
    $size = $_FILES[$filetag]['size'];
    $tmp = $_FILES[$filetag]['tmp_name'];
    $ext = pathinfo($name, PATHINFO_EXTENSION);;
    $actual_image_name = time().".".$ext;
    $bucket = 'mindwayvideos';
    $keyname =  $actual_image_name;
						
// Instantiate the client.
 $s3 = new S3Client([
     'version' => '2006-03-01',
     'region'  => 'us-west-2',
    'credentials' => [
        'key'    => 'AKIAI7IIS3OC4VMO46DA',
        'secret' => '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',
    ],
    'scheme'=>'http'
]);

try {
    // Upload data.
    $result = $s3->putObject(array(
        'Bucket' => $bucket,
        'Key'    => $keyname,
        'Body'   => fopen($tmp, 'r'),
        'ACL'    => 'public-read'
        
        
    ));

    // Print the URL to the object.
    echo $result['ObjectURL'] . "\n";
} catch (S3Exception $e) {
    echo $e->getMessage() . "\n";
}
return'http://mindwayvideos.s3.amazonaws.com/'.$actual_image_name;
}
////S3 file uploading function
function uploadVideo($filetag){
    $name = $_FILES[$filetag]['name'];
    $size = $_FILES[$filetag]['size'];
    $tmp = $_FILES[$filetag]['tmp_name'];
    $ext = pathinfo($name, PATHINFO_EXTENSION);;
    $actual_image_name = time().".".$ext;
    if (!$tmp) { // if file not chosen
			echo "<script>alert('ERROR: Please browse for a file before clicking the upload button.');</script>";
			return "";
		}else{
    $s3 = new S3Client([
     'version' => '2006-03-01',
     'region'  => 'us-west-2',
    'credentials' => [
        'key'    => 'AKIAI7IIS3OC4VMO46DA',
        'secret' => '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',
    ],
    'scheme'=>'http'
]);
		
   $uploader = new MultipartUploader($s3, $tmp, [
    'bucket' => 'mindwayvideo',
    'key'    => 'video/'.$actual_image_name,
    'ACL'    => 'public-read'
]);

try {
    $result = $uploader->upload();
    echo "<script>alert('Upload complete: {$result['ObjectURL']}\n');</script>";
} catch (MultipartUploadException $e) {
    echo $e->getMessage();
}
		
       $s3file='http://mindwayvideo.s3.amazonaws.com/video/'.$actual_image_name;
        //print_r($s3file);
        return "$s3file";
        }
	
}



///////////////////////////////////////////////////////////////////////////
function uploadImage($filetag,$folder, $width=340, $height=185, $needThumb = true) {
    
    $fileName = $_FILES[$filetag]['name'];
    $fileSize = $_FILES[$filetag]['size'];
    $fileTmpLoc = $_FILES[$filetag]['tmp_name'];
    $fileErrorMsg = $_FILES[$filetag]["error"];
    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);;
    $actual_image_name = time().".".$fileExt;
    if (!$fileTmpLoc) { // if file not chosen
			echo "<script>alert('ERROR: Please browse for a file before clicking the upload button.');</script>";
			return "";
		} else if($fileSize > 5242880) { // if file size is larger than 5 Megabytes
			echo "ERROR: Your file was larger than 5 Megabytes in size.";
			unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
			exit();
		} else if (!preg_match("/.(gif|jpg|png|jpeg)$/i", $fileName) ) {
			// This condition is only if you wish to allow uploading of specific file types    
			echo "ERROR: Your image was not .gif, .jpg, or .png.";
			unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
			exit();
		} else if ($fileErrorMsg == 1) { // if file upload error key is equal to 1
			echo "ERROR: An error occured while processing the file. Try again.";
			exit();
		}else{
        $target_file = $fileTmpLoc;
		$resized_file = $fileTmpLoc;
		$wmax =$width;
		$hmax = $height;
		ak_img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);
    $s3 = new S3Client([
     'version' => '2006-03-01',
     'region'  => 'us-west-2',
    'credentials' => [
        'key'    => 'AKIAI7IIS3OC4VMO46DA',
        'secret' => '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',
    ],
    'scheme'=>'http'
]);
		
        try {
    $s3->putObject([
        'Bucket' => 'mindwayvideo',
        'Key'    => "{$folder}/{$actual_image_name}",
        'Body'   => fopen($resized_file, 'r'),
        'ACL'    => 'public-read',
    ]);
    
} catch (Aws\Exception\S3Exception $e) {
    echo "There was an error uploading the file.\n";
}
    
        return 'http://mindwayvideo.s3.amazonaws.com/'.$folder.'/'.$actual_image_name;
        }
	
}



function deleteImage($filename){
  

$s3 = S3Client::factory(array(
    'key'    => 'AKIAI7IIS3OC4VMO46DA',
    'secret' => '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',
));

// Delete the objects in the "photos" bucket with the a prefix of "thumbs/"
$s3->deleteMatchingObjects('mindwayvideo', $filename);
    
}

//////////////////////////////////////////////////////////////////////////////////

function uploadTitleImage($filetag, $width=72, $height=72, $needThumb = true) {
	
		$fileName = $_FILES[$filetag]["name"]; // The file name
		$fileTmpLoc = $_FILES[$filetag]["tmp_name"];
		if (!$fileTmpLoc) { // if file not chosen
			//echo "ERROR: Please browse for a file before clicking the upload button.";
			return "";
		} 
		$file_sha1   = sha1_file($fileTmpLoc); // File in the PHP tmp folder
		$fileType = $_FILES[$filetag]["type"]; // The type of file it is
		$fileSize = $_FILES[$filetag]["size"]; // File size in bytes
		$fileErrorMsg = $_FILES[$filetag]["error"]; // 0 for false... and 1 for true
		//$kaboom = explode(".", $fileName); // Split file name into an array using the dot
		//$fileExt = end($kaboom); // Now target the last array element to get the file extension
		 $file_ext= pathinfo($fileName, PATHINFO_EXTENSION);

            // Creates unique name for uploaded file
            $target_name = "video_icon".$file_sha1 . '.' . $file_ext;
		// START PHP Image Upload Error Handling --------------------------------------------------
		if (!$fileTmpLoc) { // if file not chosen
			echo "ERROR: Please browse for a file before clicking the upload button.";
			return "";
		} else if($fileSize > 5242880) { // if file size is larger than 5 Megabytes
			echo "ERROR: Your file was larger than 5 Megabytes in size.";
			unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
			exit();
		} else if (!preg_match("/.(gif|jpg|png|jpeg)$/i", $fileName) ) {
			// This condition is only if you wish to allow uploading of specific file types    
			echo "ERROR: Your image was not .gif, .jpg, or .png.";
			unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
			exit();
		} else if ($fileErrorMsg == 1) { // if file upload error key is equal to 1
			echo "ERROR: An error occured while processing the file. Try again.";
			exit();
		}
		
		// END PHP Image Upload Error Handling ----------------------------------------------------
		// Place it into your "uploads" folder mow using the move_uploaded_file() function
		//$moveResult = move_uploaded_file($fileTmpLoc, "images/upload/$target_name");
		// Check to make sure the move result is true before continuing
		//if ($moveResult != true) {
			//echo "ERROR: File not uploaded. Try again.";
			//unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
			//exit();
		//}
		//unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
		// ---------- Include Universal Image Resizing Function --------
		//include_once("ak_php_img_lib_1.0.php");
		$target_file = $fileTmpLoc;
		$resized_file = "images/videoTitleIcon/thumb_$target_name";
		$wmax =$width;
		$hmax = $height;
		ak_img_resize($target_file, $resized_file, $wmax, $hmax, $file_ext);
		
		// ----------- End Universal Image Resizing Function -----------
		// Display things to the page so you can see what is happening for testing purposes
		return "thumb_$target_name";
}
function uploadphoto($filetag, $width=120, $height=120, $needThumb = true) {
	$fileName = $_FILES[$filetag]["name"]; // The file name
		$fileTmpLoc = $_FILES[$filetag]["tmp_name"];
		if (!$fileTmpLoc) { // if file not chosen
			//echo "ERROR: Please browse for a file before clicking the upload button.";
			return "";
		} 
		 $file_sha1   = sha1_file($fileTmpLoc); // File in the PHP tmp folder
		$fileType = $_FILES[$filetag]["type"]; // The type of file it is
		$fileSize = $_FILES[$filetag]["size"]; // File size in bytes
		$fileErrorMsg = $_FILES[$filetag]["error"]; // 0 for false... and 1 for true
		//$kaboom = explode(".", $fileName); // Split file name into an array using the dot
		//$fileExt = end($kaboom); // Now target the last array element to get the file extension
		 $file_ext= pathinfo($fileName, PATHINFO_EXTENSION);

            // Creates unique name for uploaded file
            $target_name = "user".$file_sha1 . '.' . $file_ext;
		// START PHP Image Upload Error Handling --------------------------------------------------
		if (!$fileTmpLoc) { // if file not chosen
			echo "ERROR: Please browse for a file before clicking the upload button.";
			exit();
		} else if($fileSize > 5242880) { // if file size is larger than 5 Megabytes
			echo "ERROR: Your file was larger than 5 Megabytes in size.";
			unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
			exit();
		} else if (!preg_match("/.(gif|jpg|png|jpeg)$/i", $fileName) ) {
			// This condition is only if you wish to allow uploading of specific file types    
			echo "ERROR: Your image was not .gif, .jpg, or .png.";
			unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
			exit();
		} else if ($fileErrorMsg == 1) { // if file upload error key is equal to 1
			echo "ERROR: An error occured while processing the file. Try again.";
			exit();
		}
		
		// END PHP Image Upload Error Handling ----------------------------------------------------
		
		//include_once("ak_php_img_lib_1.0.php");
		$target_file = $fileTmpLoc;
		$resized_file = "images/photo/thumb_$target_name";
		$wmax =$width;
		$hmax = $height;
		ak_img_resize($target_file, $resized_file, $wmax, $hmax, $file_ext);
		
		// ----------- End Universal Image Resizing Function -----------
		// Display things to the page so you can see what is happening for testing purposes
		return "thumb_$target_name";
}

function uploadAdvertisementImage($filetag, $width=150, $height=300, $needThumb = true) {
	$fileName = $_FILES[$filetag]["name"]; // The file name
		$fileTmpLoc = $_FILES[$filetag]["tmp_name"];
		if (!$fileTmpLoc) { // if file not chosen
			//echo "ERROR: Please browse for a file before clicking the upload button.";
			return "";
		} 
		 $file_sha1   = sha1_file($fileTmpLoc); // File in the PHP tmp folder
		$fileType = $_FILES[$filetag]["type"]; // The type of file it is
		$fileSize = $_FILES[$filetag]["size"]; // File size in bytes
		$fileErrorMsg = $_FILES[$filetag]["error"]; // 0 for false... and 1 for true
		
		 $file_ext= pathinfo($fileName, PATHINFO_EXTENSION);

            // Creates unique name for uploaded file
            $target_name = "adv".$file_sha1 . '.' . $file_ext;
		// START PHP Image Upload Error Handling --------------------------------------------------
		if (!$fileTmpLoc) { // if file not chosen
			echo "ERROR: Please browse for a file before clicking the upload button.";
			exit();
		} else if($fileSize > 5242880) { // if file size is larger than 5 Megabytes
			echo "ERROR: Your file was larger than 5 Megabytes in size.";
			unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
			exit();
		} else if (!preg_match("/.(gif|jpg|png|jpeg)$/i", $fileName) ) {
			// This condition is only if you wish to allow uploading of specific file types    
			echo "ERROR: Your image was not .gif, .jpg, or .png.";
			unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
			exit();
		} else if ($fileErrorMsg == 1) { // if file upload error key is equal to 1
			echo "ERROR: An error occured while processing the file. Try again.";
			exit();
		}
		
		// END PHP Image Upload Error Handling ----------------------------------------------------
		
		$target_file = $fileTmpLoc;
		$resized_file = "images/advertisement/thumb_$target_name";
		$wmax =$width;
		$hmax = $height;
		ak_img_resize($target_file, $resized_file, $wmax, $hmax, $file_ext);
		
		// ----------- End Universal Image Resizing Function -----------
		// Display things to the page so you can see what is happening for testing purposes
		return "thumb_$target_name";
}
function refValues($arr){
    if (strnatcmp(phpversion(),'5.3') >= 0) //Reference is required for PHP 5.3+
    {
        $refs = array();
        foreach((array)$arr as $key => $value)
            $refs[$key] = &$arr[$key];
        return $refs;
    }
    return $arr;
}


function checkLogined($admin = false, $redirect = true, $goto = "") {
	//global $dbUser;

	if(isset($_SESSION['userid']) /*&& (!$admin || $dbUser->isAdminUser($_SESSION['userid']))*/) 
		return true;

	if ($goto == "")
		$goto = "index.php";
	if ($redirect) {
		header("Location:" . $goto);
		exit();
	}

	return false;
}

///**
// * メールを送信します
// * 送信情報はconfig.inc.phpファイルの中にあります。
// *
// * @param  array() $params mail parameters
// * @return  boolean result 
// */


function checkValidity($expr, $errormsg = "Invalid request.") {
	global $smarty;
	if (!$expr) {
		$smarty->assign('errormsg', $errormsg);
		$smarty->display('error.tpl');
		exit();
	}
}

function html_special_chars($str)
{
     return preg_replace(array('/&/', '/"/', "/'/"), array('&amp;', '&quot;', '&#39;'), $str);
}

function unescapeHTML($str) {
     return preg_replace(array('/&#39;/', '/&quot;/', '/&gt;/','/&lt;/','/&amp;/'), array("'", "\"", ">", "<", "&"), $str);
}

function ak_img_resize($target, $newcopy, $w, $h, $ext) {
    list($w_orig, $h_orig) = getimagesize($target);
  
    $img = "";
    $ext = strtolower($ext);
    if ($ext == "gif"){ 
      $img = imagecreatefromgif($target);
    } else if($ext =="png"){ 
      $img = imagecreatefrompng($target);
    } else { 
      $img = imagecreatefromjpeg($target);
    }
    $tci = imagecreatetruecolor($w, $h);
   
    imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
    imagejpeg($tci, $newcopy, 80);
}

?>
