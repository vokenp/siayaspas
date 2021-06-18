<?php
   include("assets/bin/con_db.php");
   global $db;
   $db->debug=1;
    echo "<pre>";
     $getMember = $db->Execute("select *from committemembers");
     while (!$getMember->EOF) {
     	 $rst = array();
     	 $rst = $getMember->fields;
     	 $S_ROWID = $rst["S_ROWID"];
     	 $IDNO    = $rst["IDNo"];
        $PersonnelNo    = $rst["PersonnelNo"];
          
           $randompswdPF = "#ID".$PersonnelNo;
           $randompswdID = "#ID".$IDNO;
          $record["Pwsd_PFNo"] =  md5($randompswdPF.$PersonnelNo.'GodFirst');
          $record["Pwsd_IDNo"] =  md5($randompswdID.$IDNO.'GodFirst');
         
         print_r($record);
           $criteria = "S_ROWID = '$S_ROWID'";
       $table  = "committemembers";
       $action = "UPDATE";
      //$db->AutoExecute($table,$record,$action,$criteria);
     	$getMember->MoveNext();
     }
?>