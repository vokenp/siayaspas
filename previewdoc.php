<?php
include("timeout.php");
include("assets/bin/con_db.php");
global $db;
$s_ID = filter_input(INPUT_GET, "doc");

//$db->debug=1;

  $tableName = "elementstorage" ;
    $getfiles = $rs->row($tableName," UUID='$s_ID' ");
    $Recid = $getfiles["S_ROWID"];
    $DocID = $getfiles["S_ROWID"];
   if ($Recid !="") {
        
        if ($PFNo == "") {
           $rs->logFileAction($_SESSION['sessionid'],$s_ID,$_SESSION['user'],"Access");
        }
        else
        {
           $rs->logFileAction("Android",$s_ID,$PFNo,"Access");
        }
   
    $StoragePath = $rs->getConf("AssetPath","AssetPath");
    $FileName = $getfiles["Orginal_FileName"];
    $Version = str_pad((int)$getfiles["Version"], 5, "0", STR_PAD_LEFT);

    $LastDoc  =  $Recid < 100 ? $Recid : substr($Recid,-2);
    $RecPath =  $rs->getFilePath($Recid);
    $FileName = $LastDoc.$Version."-".$FileName;
    $filepath = $StoragePath.$RecPath.$FileName;
    $oFileName = $getfiles["New_FileName"];
    
   $dir = substr(strrchr($filepath, '/'), 1);
    $filelist = explode('.', $dir);
      $ext = strtolower(end($filelist));
   $ImagesExt = array("png",'gif',"jpg","jpeg");
   $pdf = array("pdf","PDF");
   $TiffExt = array("tif","tiff");
   
   switch ($ext) {
    case in_array($ext, $TiffExt):
      $DocID = $s_ID;
      $tmpExist = $db->GetOne("select S_ROWID from tmpfiles where DocID='$DocID'");
       if ($tmpExist != "") {
         include("tmpFilePagenate.php");
       }
       elseif (class_exists("Imagick")) {
         $rs->DotiffImg($DocID);
         include("tmpFilePagenate.php");
       }
       else
       {
         echo "<h2>  The Object cannot be Display. Plugin Missing, Do you wish to Download it.</h2>";
       echo "<a href='downloaddoc.php?DocID=$s_ID' class='btn btn-success'>Download</a>";
       }

       break;
     case in_array($ext, $pdf):
       header('Content-type: application/pdf');
       header('Content-Disposition: inline;');

       echo file_get_contents($filepath);
       break;
     case in_array($ext, $ImagesExt):
       header('Content-type: image');
       header('Content-Disposition: inline;');
       echo file_get_contents($filepath);
       break;
     
     default:
       echo "<h2>  The Object cannot be Display. Do you wish to Download it.</h2>";
       echo "<a href='downloaddoc.php?DocID=$s_ID' class='btn btn-success'>Download</a>";
       break;
   }
   

   }
?>
