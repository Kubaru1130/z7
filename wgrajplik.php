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
		<h2>Wgraj nowy plik</h2>
		<?php
		session_start();
		if(!isset($_SESSION['logged'])){echo "<div class='warning_box'>Nie jesteś zalogowany!</div>";}
		else{
		if(!isset($_POST['wyslij'])){
		echo'<form action="" method="POST" ENCTYPE="multipart/form-data"> 
					 <input type="file" name="plik"/> 
					 <input type="submit" name="wyslij" value="Wyślij plik"/> 
			  </form>';
		}else{
			$fileFolder = $_GET['folder'];
			if($fileFolder=='') $fileFolder='/'.$_SESSION['logged'];
			$max_rozmiar = 10000; 
			 if (is_uploaded_file($_FILES['plik']['tmp_name']))  
				{  
				 if ($_FILES['plik']['size'] > $max_rozmiar) {echo "Przekroczenie rozmiaru $max_rozmiar"; }  
				 else  
				 {      echo 'Odebrano plik: '.$_FILES['plik']['name'].'<br/>'; 
						if (isset($_FILES['plik']['type'])) {echo 'Typ: '.$_FILES['plik']['type'].'<br/>'; } 
						move_uploaded_file($_FILES['plik']['tmp_name'],$_SERVER['DOCUMENT_ROOT'].'/zd7/pliki'.$fileFolder.'/'.$_FILES['plik']['name']); 
						echo '<a href="http://aplikacje.hekko24.pl/zd7/">Wróć do strony głównej</a>';
				} 
				}   
			   else {echo 'Błąd przy przesyłaniu danych!';} 
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