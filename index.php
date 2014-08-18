<?php
$local_file = 'config.txt';
$filepath = "path/to/file/" . $local_file;
$booleanTrue = array ("true","1","on","yes");
$contents = $data = array ();

if (file_exists($filepath) && is_file($filepath)) 
{
	//read file
	$cfile = fopen ($filepath, "r");
	while (!feof ($cfile)) {	
		$lineData = fgets ($cfile);
		
		// ignore comments and blank statements
		if (trim($lineData) == "" || substr(trim($lineData),0,1) == '#') 
			continue;
		
		//store data values in an associative array
		$data = explode ('=',trim($lineData));
		
		// var_dump($data);
		$contents [$data[0]] = $data[1];
	}
	fclose ( $cfile );
} 
else {	
	die ('Error: The file ' . $local_file . ' does not exist!');
}

//Print values
foreach ( $contents as $key => $value ) {
	switch ($key) {			
		case 'server_id':
			echo ucfirst($key) . " : " . intval($value) . "<br/>";
			break;
			
		case 'server_load_alarm':
			echo ucfirst($key) . " : " . floatval($value) . "<br/>";
			break;

		case 'verbose':
		case 'test_mode':
		case 'debug_mode':
		case 'send_notifications':
			echo in_array (strtolower($value), $booleanTrue) ? ucfirst($key) . " :  true" : ucfirst($key) . " : false"; 
			echo "<br/>";
			break;
					
		default:
			echo ucfirst(str_replace("_", ' ', $key)) . " : " . $value . "<br/>";
			break;
	}
}
