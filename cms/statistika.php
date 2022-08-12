<?php
session_start();
require_once("../klase/classBaza.php");
require_once("../klase/classLogs.php");
require_once("funkcije.php");
$db=new Baza();
if(!isset($_SESSION['id']))
{
	echo "Morate biti prijavljeni!!!<br><a href='index.php'>Prijavite se</a>";
	exit();
}
if($_SESSION['status']!="Administrator")
{
	echo "Morate biti administrator!!!<br>";
	exit();
}
?>
<!doctype html>
<html lang="sr-RS">
<?php
	include("_head.php");
?>

<body>

<div id="wrapper">
	
	<?php
		include("_header.html");
		include("_menu.html");
	?>
	
	<div id="main">
	
	
		
	
	<form method="post" action="statistika.php">
	
	<select name="log">
	<option value="0" selected>--Izaberite log--</option>
	<option value="logovanje.txt">Evidencija logovanja</option>
	<option value="vesti.txt">Evidencija vesti</option>
	<option value="korisnici.txt">Evidencija korisnika</option>
	</select><br><br>
	<input type="submit" value="Pročitaj log" />
	</form><br><br>
	<?php
		if(isset($_POST['log']) and $_POST['log']!="0")
		{
			$tekst=Logs::procitajIzDatoteke("logs/".$_POST['log']);
			echo $tekst;
		}
	?>
	</div><!-- end #main -->
	
	
	
	<?php
	include("_footer.html");
?>
	
</div><!-- end #wrapper -->


</body>
</html>












