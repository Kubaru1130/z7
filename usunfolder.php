<?php
function rrmdir($src) {
    $dir = opendir($src);
    while(false !== ( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            $full = $src . '/' . $file;
            if ( is_dir($full) ) {
                rrmdir($full);
            }
            else {
                unlink($full);
            }
        }
    }
    closedir($dir);
    rmdir($src);
}
	
if(!empty($_GET['folder'])){
    $fileFolder = $_GET['folder'];
	$user=$_SESSION['logged'];
    if($fileFolder!=''){
        rrmdir("pliki/$fileFolder");
		header("Location:index.php");		
        exit;
    }else{
        echo 'The file does not exist.';
    }
}
?>