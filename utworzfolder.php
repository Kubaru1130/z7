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
		<h2>Utwórz folder</h2>
		<?php
		session_start();
		if(!isset($_SESSION['logged'])){echo "<div class='warning_box'>Nie jesteś zalogowany!</div>";}
		else{
		if(!isset($_POST['wyslij'])){ ?>
		<table align="center" class="formularz">
			<form action="" method="post">
				<tr><td>Nazwa folderu:</td> <td><input type="text" name="nazwa"></td></tr>
				<tr><td colspan="2" align="center"><input type="submit" name="wyslij" style="cursor:pointer;" value="Utwórz folder"></td></tr>
		</form>
            </table>
		<?php } else{
		$nazwa =htmlspecialchars($_POST['nazwa']);
		$fileFolder = $_GET['folder'];
		$user=$_SESSION['logged'];
		if($fileFolder=='') mkdir("pliki/$user/$nazwa");
		else mkdir("pliki/$fileFolder/$nazwa");			
		header("Location: http://aplikacje.hekko24.pl/zd7/");
		}
		}
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