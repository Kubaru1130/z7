<?php
$listDirCount = 0;

// This function will take the path to build a list of folders and files in that folder
// Then display those folders and files according to the way the operating system shows them. 

function listDir($path = ".") {
	global $listDirCount;
	
	$folders = array();
	$files = array();
	
	// Open the given path
	if ($handle = opendir($path)) {
		// Loop through its contents adding folder paths or files to separate arrays
		// Make sure not to include "." or ".." in the listing.
		
		while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != "..") {
				if (is_dir($path . "/" . $file)) {	
					$folders[] = $path . "/" . $file;
				}
				else { $files[] = $file; }
			}
		}
		
		
		for ($i = 0; $i < count($folders); $i++) {
			$listDirCount++;
			
			$sciezka=str_replace("./pliki","",$folders[$i]);
			echo "<div style='line-height:24px;'><img src='images/folder.png' alt=''> <a style='vertical-align:middle;' href=\"javascript:void(0)\" onclick=\"showSubs($listDirCount)\">" . basename($folders[$i]) . "</a> <a style='margin-left:20px;' class='addd' href='utworzfolder.php?folder={$sciezka}'><img src='images/add.png'> Dodaj podfolder</a> <a style='margin-left:20px;' class='addd' href='wgrajplik.php?folder={$sciezka}'><img src='images/add2.png'> Wgraj plik do folderu</a> <a style='margin-left:20px;' class='addd' href='usunfolder.php?folder={$sciezka}'><img src='images/delete.png'> Usuń folder</a></div><br/>\n";
			
			echo '<div id="folder' . $listDirCount . '" style="margin-left: 15px; margin-right: 10px; display: none;">';
			listDir($folders[$i]);
			echo '</div>';
			echo '';
		}
		
		// Here we just loop and print the file names. Add icons here for files if you like.
		for ($i = 0; $i < count($files); $i++) {
			$sciezka=str_replace("./pliki","",$path);
			echo "<div style='line-height:25px;'><img src='images/file.png' alt=''> {$files[$i]} <a href='download.php?folder={$sciezka}&file={$files[$i]}' style='margin-left:10px;' class='addd' title='Pobierz plik'><img src='images/download.png'> Pobierz plik</a> <a href='usunplik.php?folder={$sciezka}&file={$files[$i]}' style='margin-left:10px;' class='addd' title='Usuńn plik'><img src='images/delete.png'> Usuń plik</a></div><br/>\n";
		}
		
		// Finally close the directory.
		closedir($handle);
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<title>Jakub Smieszek</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  	<link rel="stylesheet" href="http://aplikacje.hekko24.pl/style.css">
	<style>
	body {background: #f1f1f1;color: #474747;font: 14px/25px Arial, Helvetica, sans-serif;}
	.addd{font-size:11px;
    line-height: 16px;}
	</style>
<script>
	function showSubs(topicid) {
		var subs = document.getElementById("folder" + topicid);
		
		if (subs.style.display == "none") {
			subs.style.display = "block";
		}
		else {
			subs.style.display = "none";
		}
	}
</script>
</head>
<body>
<header>
	<div class="wrap-header grid">
		<h1 id="logo">Aplikacje sieciowe</h1>
	</div>
</header>

<nav>
	<div class="wrap-nav grid">
		 <div class="topnav" id="myTopnav">
		  <a href="/">Home</a>
		  <a href="#">Podstrona 1</a>
		  <a href="#">Podstrona 2</a>		 
		  <a href="javascript:void(0);" class="icon" onclick="menuhover()">&#9776;</a>
		</div> 	
	</div>
</nav>

<section id="content">
	<div class="wrap-content grid">
		<div class="row block01">
			<div class="col-full">
				<div class="wrap-col">
				<h2>System uploadu plików</h2><br>
<?php
session_start();
//mkdir("pliki/Kubaru");
$dbhost="localhost"; $dbuser="X"; $dbpassword="X"; $dbname="X"; 
mysql_connect($dbhost, $dbuser, $dbpassword);
mysql_select_db($dbname);
if(isset($_SESSION['logged'])){
	$loginusera=$_SESSION['logged'];
	$log = mysql_query ("select id FROM `userzy` WHERE `nick`='$loginusera'");
	$wiersz= mysql_fetch_row($log);
	$idd = $wiersz[0];
	$logowanie = mysql_query ("select data FROM `logi` WHERE `id_usera`='$idd' AND status=0 ORDER BY ID DESC");
	if(mysql_num_rows($logowanie)>0){
		$wiersza= mysql_fetch_row($logowanie);
		$datalogowania = $wiersza[0];		
		echo "Ostatnie błędne logowanie do systemu: $datalogowania <br><br>";
	}
	echo '<a href="utworzfolder.php"><img src="images/add.png"> Utwórz folder główny</a> <a href="wgrajplik.php"><img src="images/add2.png"> Wgraj plik do folderu głównego</a><br><br>';
	listDir("./pliki/$loginusera");
}
else{
	echo '<a href="logowanie.php">Logowanie</a> | <a href="rejestracja.php">Rejestracja</a>';
}
?>
</div>
			</div>
		</div>
		
	</div>
</section>
<footer>
	<div class="wrap-footer">
		<div class="copyright">
			<p>Copyright © 2017</p>
		</div>
	</div>
</footer>
<script>
function menuhover() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
} 
</script>
</body>
</html>