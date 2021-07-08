<?php
session_start();
//Dir

PHP_OS == "Windows" || PHP_OS == "WINNT" ? define("SEPARATOR", "\\") : define("SEPARATOR", "/");
$dirname = str_replace(SEPARATOR, '/', dirname(__FILE__));
  $dirFile = str_replace($_SERVER['DOCUMENT_ROOT']."/",'', $dirname);
  $dlist = explode("/",$dirFile);

//Dir
  $dlist[0] = "credoadmin";
define('DIR_ROOT', $_SERVER['DOCUMENT_ROOT']."/".$dlist[0]."/");
define('DB_LOGS', DIR_ROOT.'logs/');

//define('DB_DRIVER', 'SQL Server');
$conf = apiStore::configs("DB");
define('DB_DRIVER', 'mysqli');

if (DB_DRIVER == "mysqli") {

define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', $conf["DB_USERNAME"]);
define('DB_PASSWORD', $conf["DB_PASSWORD"]);
define('DB_DATABASE', "siayaspas");
define('DB_PREFIX', 'dh_');
if (!defined('DB_PORT')) define('DB_PORT', '3306');

    $db = ADONewConnection(DB_DRIVER);
    $db->Connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    ADOdb_Active_Record::SetDatabaseAdapter($db);

    class ORM extends ADODB_Active_Record {}
}
else
{

define('DB_HOSTNAME', 'QUARTO-PC');
define('DB_USERNAME', 'sa');
define('DB_PASSWORD', 'casemanager@123');
define('DB_DATABASE', 'triabiosms');
define('DB_PREFIX', 'DH_');

    $db = ADONewConnection('odbc_mssql');

     $dsn = "Driver={".DB_DRIVER."};Server=".DB_HOSTNAME.";Database=".DB_DATABASE.";";

       $db->Connect($dsn,DB_USERNAME,DB_PASSWORD);



       ADOdb_Active_Record::SetDatabaseAdapter($db);


    class ORM extends ADODB_Active_Record {}
}



 class VToken
 {
  public static function genT()
  {
        return $_SESSION["_token"] =  str_shuffle(base64_encode(openssl_random_pseudo_bytes(32)));
  }

  public static function checkT($vtoken)
  {
      if (isset($_SESSION["_token"])  && $vtoken === $_SESSION["_token"]) {
          unset($_SESSION["_token"]);
          return true;
      }
        return false;
  }
 }


?>
