<?php
$gc_period = 1200;

session_start();
if (file_exists($gc_time)) {
    if (filemtime($gc_time) < time() - $gc_period) {
        session_gc();
        touch($gc_time);
    }
} else {
    touch($gc_time);
}

// set timeout period in seconds
$inactive = 1200;
// check to see if $_SESSION['timeout'] is set
if(isset($_SESSION['timeout']) ) {
	$session_life = time() - $_SESSION['timeout'];
	if($session_life > $inactive)
        { 
         header("Location: logout.php"); 
          echo "logout";
     }
}
$_SESSION['timeout'] = time();

 /* error_reporting(E_ALL);
ini_set('display_errors', 1);
  $path = realpath("doh_sql.xml");
$xml_file = file_get_contents($path,FILE_TEXT);
$xml = new SimpleXMLElement($xml_file);

  foreach($xml->children() as $child)
  {
   define($child->getName(), $child);
  }*/

?>



