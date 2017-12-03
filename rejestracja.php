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
				<div id="przyklad">
		<h2 class="info">Rejestracja nowego użytkownika</h2>
		<div style="position:relative;margin-left:50px;"><br/><br/>
		<?php
		session_start();
		$dbhost="localhost"; $dbuser="X"; $dbpassword="X"; $dbname="X"; 
		mysql_connect($dbhost, $dbuser, $dbpassword);
		mysql_select_db($dbname);
		if(isset($_SESSION['logged'])){echo "<div class='warning_box'>Jesteś już zalogowany!</div>";}
		else{
		if(!isset($_POST['wyslij'])){ ?>
		<table>
		<form action="" method="POST" id="myform">
		<tr><td class="rowtd">Login: <span style="color:#d81417">*</span></td><td><input type="text" title="Login" name="login" maxlength="20"></input></td></tr>
		<tr><td class="rowtd">Hasło: <span style="color:#d81417">*</span></td><td><input type="password" name="haslo" maxlength="20"></input></td></tr>
		<tr><td class="rowtd">Powtórz hasło: <span style="color:#d81417">*</span></td><td><input type="password" name="haslo2" maxlength="20"></input></td></tr>
		<tr><td class="rowtd">Adres e-mail: <span style="color:#d81417">*</span></td><td><input type="text" name="mail" maxlength="20"></input></td></tr>
		<tr><td colspan="2" align="center"><input name="wyslij" value="Wyślij" style="cursor:pointer;" type="submit"></input></td></tr>
		</form>
		</table>
		<?php } else{
		$login = mysql_real_escape_string(htmlspecialchars($_POST['login']));
		$haslo = mysql_real_escape_string(htmlspecialchars($_POST['haslo']));
		$haslo2 = mysql_real_escape_string(htmlspecialchars($_POST['haslo2']));
		$mail = mysql_real_escape_string(htmlspecialchars($_POST['mail']));
		
		$sprawdzanie = mysql_query("SELECT * FROM `userzy` WHERE nick = '$login'");
		$zapytanie = mysql_num_rows($sprawdzanie);
		if($zapytanie) $error[]="Niestety ten login jest już używany!";
			
		if(!(strlen(trim($login)))) $error[]="Musisz wpisać login!";
		elseif( strlen(trim($login)) > 20 ) $error[]="Podany login jest zbyt dlugi (max. 20 znakow).";
		elseif( strlen(trim($login)) < 4 ) $error[]="Podany login jest zbyt krótki (min. 4 znakow).";
		 if($haslo == $haslo2) {
			if(!(strlen(trim($haslo)))) $error[]="Musisz wpisac haslo!";
			}
		else $error[]="Wpisane hasla nie zgadzaja sie!";
				
		if (is_array($error)) {
            echo '<table width="300" class="tableform" cellpadding="0" cellspacing="1">
						<tr height="50">
							<td align="center" class="costam"><b>Wystąpiły błędy:</b></td>
						</tr>
						<tr>
							<td align="center" class="costam">';
            foreach ($error as $problemy) {
                echo '<li>' . $problemy . '</li>';
            }
            echo '</td></tr>';
            echo '<tr height="50"><td align="center" class="costam"><input type="button" class="form" onClick="javascript:history.back()" value="Cofnij"></td></tr></table>';
        }
		else{
		mkdir("pliki/$login");
		$password_hash = md5($haslo);
		
		mysql_query('INSERT INTO `userzy` (`id`, `nick`, `haslo`,`mail`,`level`) VALUES ("", "'.mysql_real_escape_string($login).'", "'.mysql_real_escape_string($password_hash).'", "'.mysql_real_escape_string($mail).'",0)');
		echo "Dziękujemy za rejestrację. Możesz się teraz zalogować! <a href='logowanie.php'>Logowanie</a>";

		}
		}}
		?>
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