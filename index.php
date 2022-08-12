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
<title>Vesti.com</title>

<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i&amp;subset=latin-ext" rel="stylesheet">

<link href="fa/css/font-awesome.min.css" type="text/css" rel="stylesheet">
<link href="css/style.css" type="text/css" rel="stylesheet"  >


</head>

<body>

<div id="wrapper">
	
	<div id="header">
	
	<div id="slogan"><p>
<ol>
			 <li>Zivot je lep</li>
			 <li>Sve sto mozes da zamislis, mozes i da ostvaris</li>
			 <li>Uspeh nedolazi sam po sebi</li>
			<li> Budi jaci od svojih izgovora</li>
			 <li>Sve dolazi ako covek hoce cekati</li>
			 </p></ol>
	</div>
	
	
		
		<div id="logo">
			<img src="slike/logo.jpg" alt="sindja"></div>
			
		</div>	
	<!-- end #header -->
	
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
			<?php
			if(isset($_SESSION['kor_id']))
			{
				echo '<li><a href="#">'.$_SESSION['ime'].'</a>
			<ul>
			
			<li><a href="cms/index.php?logout">Odjava</a></li>
			
			</ul>
			</li>';
			}
			else
			{
				echo '<li><a href="cms/index.php">Prijava </a></li>
					';
			}
		?>
		<li><a href="registracija.php">Registracija</a></li>
			
		
	</div><!-- end #nav -->
	
	<div id="main">
	
	
	<?php

	$upit="SELECT * FROM viewvesti WHERE obrisan=0 ORDER BY id desc";
	if(isset($_GET['idKategorije'])) $upit="SELECT * FROM viewvesti WHERE obrisan=0 and kategorija=".$_GET['idKategorije'];
	if(isset($_GET['idAutora'])) $upit="SELECT * FROM viewvesti WHERE obrisan=0 and autor=".$_GET['idAutora'];
	if(isset($_POST['pretraga'])) $upit="SELECT * FROM viewvesti WHERE obrisan=0 and (sadrzaj LIKE ('%".$_POST['pretraga']."%') or naslov LIKE ('%".$_POST['pretraga']."%') or ime LIKE ('%".$_POST['pretraga']."%'))";
	if(isset($_GET['idVesti'])) $upit="SELECT * FROM viewvesti WHERE obrisan=0 and id=".$_GET['idVesti'];
	$rez=$db->izvrsiUpit($upit);
	while($red=$db->procitajRed($rez))
	{
		
		
		
		echo "<h2><a href='index.php?idVesti=$red->id'>".$red->naslov."</a></h2>";
		if($red->slikavesti!="")echo "<img src='slike/$red->slikavesti' width='200px' alt='slika'/><br><br>";
	
		if(isset($_GET['idVesti']))
			echo "<font color='black'><b>".$red->sadrzaj."<br><br>";
		else
		{
			$niz=explode(" ", $red->sadrzaj);
			$br=count($niz);
			if($br>25)$br=25;
			for($i=0;$i<$br;$i++)
				echo $niz[$i]." ";
			echo "...<br>";
		}
		
		
		echo "<font color='white'><b>".$red->vreme."</b></font><br>";

	}
	?>
	
		
	
	
	
	
	
	
		
	</div><!-- end #main -->
	
	<div id="sidebar">
	
	
		
		
	
	</div><!-- end #sidebar -->
	
				<div id="footer">
					<p>Copyright &copy; Vesti 2018</p>
				</div><!-- end #footer -->
	
</div><!-- end #wrapper -->


</body>
</html>
