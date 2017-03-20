<?php 
$files = scandir('photos');
$n = array();
foreach ($files as $key => $file) {
	if ($file == '.' || $file == '..'  || substr($file, 0, 1) == '.') {
		continue;
	}
	$n[] = $file;
}
echo json_encode($n);
