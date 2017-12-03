<?php
if(!empty($_GET['file'])){
    $fileName = basename($_GET['file']);
	$fileFolder = $_GET['folder'];
    $filePath = 'pliki/'.$fileName;
	if($fileFolder){
		$filePath = 'pliki/'.$fileFolder.'/'.$fileName;
	}
    if(!empty($fileName) && file_exists($filePath)){
        unlink($filePath);
		header("Location:index.php");		
        exit;
    }else{
        echo 'The file does not exist.';
    }
}
?>