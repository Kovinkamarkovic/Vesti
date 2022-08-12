<?php
require_once("klase/classBaza.php");
$db=new Baza();
if(mysqli_connect_error())
{
	echo "Baza nije dostupna!!!!";
	exit();
}
?>
<!doctype html>
<html lang="sr-RS">
<head>
<meta charset="utf-8">
<title>Untitled Document</title>

<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i&amp;subset=latin-ext" rel="stylesheet">

<link href="fa/css/font-awesome.min.css" type="text/css" rel="stylesheet">

<link href="css/style.css" type="text/css" rel="stylesheet">
<link href="lightbox2-master/src/css/lightbox.css" rel="stylesheet">
<script src="lightbox2-master/dist/js/lightbox-plus-jquery.js"></script>
</head>

<body>

<div id="wrapper">
	
	<div id="header">
	
		<div id="logo">
			<img src="slike/logo.jpg" alt="">
		</div>
		
		<div id="slogan"><p>
<ol>
			 <li>Zivot je lep</li>
			 <li>Sve sto mozes da zamislis, mozes i da ostvaris</li>
			 <li>Uspeh nedolazi sam po sebi</li>
			<li> Budi jaci od svojih izgovora</li>
			 <li>Sve dolazi ako covek hoce cekati</li>
			 </p></ol>
	</div>
	</div><!-- end #header -->
	
	<div id="nav">
	
		<ul>
			<li><a href="index.php">Početna</a></li>
			<?php
			$upit="SELECT * FROM kategorija";
			$rez=$db->izvrsiUpit($upit);
			while($red=$db->procitajRed($rez))
			{
				echo "<li><a href='index.php?idKategorije=$red->id'>$red->naziv</a></li>";
			}
			?>
			<li><a href="katalog.php">Galerije</a></li>
			<li><a href="registracija.php">Registracija</a></li>
			<li><a href="cms/index.php">Prijava </a></li>
			
		</ul>
		</div><!-- end #nav -->
		<div id="sidebar">
		
	
	</div>
	

<script  src="jquery-3.3.1.js"></script>
 <script> 
$(document).ready(function(){
	//alert("test");
	$("#dugme").click(function(){
		//alert("test");
		//PROVERA PODATAKA JE OBAVEZNA
		var greska="";
		if($("#ime").val()=="" || $("#email").val()=="") 
			greska="Nisu uneti svi podaci";
		//alert($("#lozinka").val()+"\n"+$("#plozinka").val());
		if($("#lozinka").val()!=$("#plozinka").val()) 
			greska="Lozinka i ponovljena lozinka nisu iste";
		if(greska!="")
		{
			$("#obavestenje").html(greska);
			return false;
		}
		$.post("ajax.php",{ime: $("#ime").val(), prezime: $("#prezime").val(),email: $("#email").val(), lozinka: $("#lozinka").val(), grad: $("#grad").val()},function(odgovor){
			$("#obavestenje").html(odgovor);
		});
		
	});
});
</script>
</head>
<body>
<h1>Registracija</h1>

<input type="text" id="ime" placeholder="Unesite ime"/><br></br>
<input type="text" id="prezime" placeholder="Unesite prezime"/><br></br>
<input type="text" id="email" placeholder="Unesite email"/><br></br>
<input type="text" id="lozinka" placeholder="Unesite lozinku"/><br></br>
<input type="text" id="plozinka" placeholder="Unesite ponovljenu lozinku"/><br></br>
<input type="text" id="grad" placeholder="Unesite grad"/><br></br>
<button type="button" id="dugme">Snimite podatke</button>
<div id="obavestenje"></div>

</body>
</html>