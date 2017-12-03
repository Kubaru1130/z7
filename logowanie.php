<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<title>Jakub Smieszek</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  	<link rel="stylesheet" href="http://aplikacje.hekko24.pl/style.css">

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
<div id="srodek">
	<div id="przyklad">
		<h2>Logowanie w serwisie</h2>
		<?php
		session_start();
		$dbhost="localhost"; $dbuser="X"; $dbpassword="X"; $dbname="X"; 
		mysql_connect($dbhost, $dbuser, $dbpassword);
		mysql_select_db($dbname);
		if(isset($_SESSION['logged'])){echo "<div class='warning_box'>Jesteś już zalogowany!</div>";}
		else{
		if(!isset($_POST['wyslij'])){ ?>
		<table align="center" class="formularz">
			<form action="" method="post">
				<tr><td>Login:</td> <td><input type="text" name="login"></td></tr>
				<tr><td>Hasło:</td> <td><input type="password" name="haslo"></td></tr>
				<tr><td colspan="2" align="center"><input type="submit" name="wyslij" style="cursor:pointer;" value="Zaloguj"></td></tr>
		</form>
            <tr><td colspan="2"><b><br/><a href="rejestracja.php">Nie masz konta? Zarejestruj się!</a></b></td></tr></table>
		<?php } else{
		
		
	$login = mysql_real_escape_string(htmlspecialchars($_POST['login']));
	$haslo = mysql_real_escape_string($_POST['haslo']);
	$status = mysql_query ("select `id`,`level` FROM `userzy` WHERE `nick`='$login'");
	$wiersz= mysql_fetch_row($status);
	$idd=$wiersz[0];
	$blokada=$wiersz[1];
	
	$logowanie = mysql_query ("select data FROM `logi` WHERE `id_usera`='$idd' ORDER BY ID DESC LIMIT 1");
	$wiersza= mysql_fetch_row($logowanie);
	$datalogowania = $wiersza[0];
	
	$obecna_data = date("Y-m-d H:i:s");  
	$pozostalo = (strtotime($obecna_data) - strtotime($datalogowania));	

	if($blokada>2 AND $pozostalo<300){
		echo 'Twoje konto zostało zablokowane na 5min';
	}else{
		$loguj = mysql_query ("select `id`,`level` FROM `userzy` WHERE `nick`='$login' and haslo = md5('$haslo')");//pobranie z bazy loginu i hasła wpisanego w formularzu
		if(mysql_num_rows($loguj)>0)
		{	
		$row= mysql_fetch_row($loguj);
		$idusera=$row[0];
		$level=$row[1];
		mysql_query('INSERT INTO `logi` VALUES ("", "'.mysql_real_escape_string($idusera).'", NOW(),1)');
		mysql_query("UPDATE `userzy` SET level=0 WHERE id='$idusera'");
		$_SESSION['logged'] = $login; 
		header("Location: http://aplikacje.hekko24.pl/zd7/index.php");
		
		}
		else
		{
		$loguj = mysql_query ("select `id`,`level` FROM `userzy` WHERE `nick`='$login'");//pobranie z bazy loginu i hasła wpisanego w formularzu	
		if(mysql_num_rows($loguj)>0){
			$row= mysql_fetch_row($loguj);
			$idusera=$row[0];
			$level=$row[1];
			if($level>3) $level=1;
			else $level++;
			mysql_query('INSERT INTO `logi` VALUES ("", "'.mysql_real_escape_string($idusera).'", NOW(),0)');
			mysql_query("UPDATE `userzy` SET level='$level' WHERE id='$idusera'");
		}
		echo 'Podane dane nie zgadzają się!<br><input type="button" onClick="javascript:history.back()" value="Cofnij">';
		}
	}	
		}}
		?>
	</div>
	<div class="boxy">
	</div>
</div>

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