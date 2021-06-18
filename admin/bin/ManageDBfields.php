<?php 
include("../../timeout.php");
 include("../../assets/bin/con_db.php");
 global $db;
 //$db->debug=1;
 error_reporting(E_ALL);
ini_set('display_errors', 1);
 $user = $_SESSION['user'];
 if (!isset($_SESSION['user'])) {
     header("Location: ../index.php");
     die();     
}

$dict = NewDataDictionary($db);

 
 if (isset($_POST['CreateNewTbl'])) 
 {
 	$TableName = safehtml($_POST['CreateNewTbl']);
 	$columns = "S_ROWID R AUTO PRIMARY KEY,CreatedBy C(255) DEFAULT 'ADMIN',DateCreated T DEFTIMESTAMP,ModifiedBy C(255),DateModified T";
	$sqlarray = $dict->createTableSql($TableName,$columns);
	$exec = $dict->executeSqlArray($sqlarray);
	 if ($exec) {
	 	echo "Success";
	 }
 }

 if (isset($_POST['AlterColumn'])) {
 	
 }


 if (isset($_POST['btnAddColumn'])) {
 	 
 	$CurrentTable = safehtml($_POST['CurrentTable']);
    $ColumnName = safehtml($_POST['ColumnName']);
    $DisplayName = safehtml($_POST['DisplayName']);
    $DataType = safehtml($_POST['DataType']);
    $DefaultValue = safehtml($_POST['DefaultValue']);
    
    $Ctypes = array("C","C2");
    $ColLen = in_array($DataType, $Ctypes) ? "(255)" : "";
    $DefValue = $DefaultValue != "" ? "NOTNULL DEFAULT '$DefaultValue'" : "NULL";
      if ($DataType == "N") {
      	$columns = "$ColumnName $DataType 12.2";
      }
      else
      {
      	$columns = "$ColumnName $DataType".$ColLen." $DefValue";
      }
    
    $sqlArray = $dict->addColumnSql($CurrentTable,$columns);

        $dict->executeSqlArray($sqlArray);	
   if ($dict) {
	 	echo "Success";

    // save to columns
      $record["TblName"] = $CurrentTable;
      $record["DisplayName"] = $DisplayName;
      $record["FieldName"] = $ColumnName;
      $record["DataType"] = $DataType;
      $record["CreatedBy"] = $user;

      $table  = "dh_columns";
      $action = "INSERT";
      $db->AutoExecute($table,$record,$action);
        if ($db) {
          $S_ROWID = $db->GetOne("select max(S_ROWID) from $table");
          logAction($S_ROWID,$table,$user,$action,$record,999);
          //$log->write($log->makesql($table,$record,$action));
        }
        else
        {
          echo "Error in saving Record reason because :".$db->ErrorMsg();
        }
	 }
	 else
	 {
	 	echo "Error :".$dict->ErrorMsg();
	 }
 
 }


  if (isset($_POST['RenameColumn'])) {
    $TableName = safehtml($_POST['RenameColumn']);
 	$OldColName = safehtml($_POST['OldColName']);
 	$NewColName = safehtml($_POST['NewColName']);
 	
 	  if (DB_DRIVER == "mysqli") {
 	  	 $ar = $db->metaColumns($TableName);
         $cols = array();
         foreach ($ar as $key => $value) {
  	      $cols[$key] = (array)$value;
         }
         $ColDef = $cols[strtoupper($OldColName)];
        
          $Ctypes = array("C","C2");
         $AdoType = $db->metaType($ColDef["type"]);
         $MaxLen = $ColDef["max_length"];
         $ColLen = in_array($AdoType, $Ctypes) ? "($MaxLen)" : "";
         $flds = "$NewColName $AdoType".$ColLen;
          
 	  	$sqlArray  = $dict->renameColumnSql($TableName,$OldColName,$NewColName,$flds);
 	  }
 	  else
 	  {
 	  	$sqlArray  = $dict->renameColumnSql($TableName,$OldColName,$NewColName);
 	  }
    
   $exec =  $dict->executeSqlArray($sqlArray);	

   if ($exec) {
	 	echo "Success";
	 }
 }


  if (isset($_POST['DropColumn'])) {
 	$TableName = safehtml($_POST['DropColumn']);
 	$ColName = safehtml($_POST['ColName']);
    $sqlArray  = $dict->dropColumnSql($TableName,$ColName);
    $dict->executeSqlArray($sqlArray);

    $exec =  $dict->executeSqlArray($sqlArray);	

   if ($exec) {
	 	echo "Success";
	 }
 
 }

?>