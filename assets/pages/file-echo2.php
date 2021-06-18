<?php
 include("../../timeout.php");
 $user = $_SESSION['user'];
include("../../assets/bin/con_db.php");
//$db->debug=1; 
   error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('post_max_size', '100M');
ini_set('upload_max_filesize', '100M');

$StoragePool = $_POST['StoragePool'];
$upload_dir = $rs->getConf("AssetPath","AssetPath"); // The directory for the images to be saved in
$upload_dir = $upload_dir == "" ? DIR_ROOT."assets/StoragePool/" : $upload_dir;

$upload_path = $upload_dir;
if ($rs->endsWith($upload_dir,'/') == false) 
{
   $upload_path = $upload_dir."/";
}	// The path to where the image will be saved

//$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 

if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
	//Get the file information
	$userfile_name = $_FILES['uploadedfile']['name'];
	$userfile_tmp = $_FILES['uploadedfile']['tmp_name'];
	$userfile_size = $_FILES['uploadedfile']['size'];
	$filename = basename($_FILES['uploadedfile']['name']);
	$filelist = explode('.', $filename);
	$file_ext = strtolower(end($filelist));
   
    $docID = getID("elementstorage");
    $version  = str_pad("1", 5, "0", STR_PAD_LEFT);
    $LastDoc  =  $docID < 100 ? $docID : substr($docID,-2);
    $DestPath =  $rs->getFilePath($docID);
    $FileName = $LastDoc.$version."-".$filename;
    $large_image_name  = $FileName;
    $rs->makeDir($upload_path,$DestPath);
//Image Locations
$large_image_location = $upload_path.$DestPath.$large_image_name;
  
if (move_uploaded_file($userfile_tmp, $large_image_location)){
		   
			chmod($large_image_location, 0777);
			
		$pos = strstr($large_image_name,'.');
		$strFileName = basename($large_image_name, $pos);	

		//do your saving to db here the path is $large_image_location
		      $record["StoragePath"] = $upload_path;
          $record["FileSize"] = $userfile_size; 
          $record["StoragePool"] = $StoragePool; 
          $record["Orginal_FileName"] = $filename; 
          $record["New_FileName"] = $_POST["DocumentTitle"].".".$file_ext; 
          $record["FileExt"] = $file_ext;
          $record["CreatedBy"] = $user;  
          $record["FileDescription"] = $_POST["DocDescription"];

            $Descrip = $_POST["DocumentTitle"];
            $table ="elementstorage";
            $action = "INSERT";
            $db->AutoExecute($table,$record,$action);

      if ($file_ext == "tif" && class_exists("Imagick")) {
           $rs->DotiffImg($docID);
      } 

      /* if ($file_ext == "pdf" && class_exists("Imagick") {
            $image = new Imagick();
            $image->pingImage($userfile_tmp);
            $record["PageCount"] = $image->getNumberImages();
          }*/

    echo "Upload Successful";
		}
		else
		{
		echo "Upload failed! Please try Again.";	
		}

}  

?>