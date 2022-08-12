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
<title>Vesti</title>

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
			<img src="slike/logo.jpg" alt="Lineweb">
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
			<li><a href="cms/index.php">Prijava </a></li>
			
		</ul>
		</div><!-- end #nav -->
		
	
	<div id="main">
	<?php
	$upit="SELECT * FROM galerije order by vreme desc";
	$rez=$db->izvrsiUpit($upit);
	if($db->brojRedova($rez)>0)
	{
		echo "<ul>";
		while($red=$db->procitajRed($rez))
			echo "<li><a href='katalog.php?idGalerije=$red->id'>$red->nazivGalerije</a></li>";
		echo "</ul>";
	}else
		echo "Nema ni jedna galerija u bazi!!!!<br>";
	?>

	<center>
	<?php
	if(isset($_GET['idSlike']))
	{
		$idSlike=$_GET['idSlike'];
		$upit="SELECT * FROM galerijeslike WHERE id=$idSlike";
		$rez=$db->izvrsiUpit($upit);
		$red=$db->procitajRed($rez);
		echo "<img src='galerije/$red->slika' alt='Nema slike' height='200px' class='galerija' /><br>$red->komentar";
	}
	?>
	
	<?php
	if(isset($_GET['idGalerije']))
	{
		$idGalerije=$_GET['idGalerije'];
		$upit="SELECT * FROM galerijeslike WHERE idGalerije=$idGalerije";
		$rez=$db->izvrsiUpit($upit);
		if($db->brojRedova($rez)>0)
		{
			while($red=$db->procitajRed($rez))
				echo "<a href='katalog.php?idGalerije=$idGalerije&idSlike=$red->id'><img  src='galerije/$red->slika' alt='Nema slike' height='100px' class='galerija' /></a>";
		}else
			echo "Nema nijedna slika za izabranu galeriju!!!!<br>";
	}
	?>
	
	</center>
		
	</div><!-- end #main -->
	
	<div id="sidebar">
		
	
	</div><!-- end #sidebar -->
	
	<div id="footer">
	
		<p>Copyright &copy; Vesti 2018</p>

	</div><!-- end #footer -->
	
</div><!-- end #wrapper -->


</body>
</html>












