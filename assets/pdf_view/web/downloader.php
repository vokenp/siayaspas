<?php 

	/*if(isset($_GET["url"])){
		$url=$_GET["url"];
	}
	else{
		echo "No document url specified";
		exit;
	}*/
	
	$url="https://apps.quarto.co.ke/assemblydocs/test.pdf";
	set_time_limit(0);
	// $url="https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf";
	$url=str_replace(" ","%20",$url);

	$file_path="temp.pdf";
	$fp=fopen($file_path, 'w');

	$start=curl_init();
	curl_setopt($start, CURLOPT_URL, $url);
	curl_setopt($start, CURLOPT_RETURNTRANSFER, 1);

	curl_setopt($start, CURLOPT_HEADER, false);

	curl_setopt($start, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($start, CURLOPT_SSL_VERIFYPEER, 0);

	//$file_data=curl_exec($start);
	curl_close($start);
	file_put_contents($file_path, $file_data);

	// echo $url;
	// header("Location: "."viewer.html?file=temp.pdf");
	header("Location: "."viewer.html?file=$url");
	// curl_close(ch);

 ?>