<?php
session_start();
require_once("../klase/classBaza.php");
require_once("../klase/classLogs.php");
require_once("funkcije.php");
$db=new Baza();
if(!isset($_SESSION['id']))
{
	echo "Morate biti prijavljeni!!!!<br><a href='index.php'>Prijavite se</a>";
	exit();
}
if($_SESSION['status']!="Administrator")
{
	echo "Morate biti administrator!!!!<br>";
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
	
	
		
	<?php
		if(isset($_POST['idvesti']) and $_POST['idvesti']!="0")
		{
			$upit="UPDATE vesti SET obrisan=1 WHERE id=".$_POST['idvesti'];
			$db->izvrsiUpit($upit);
			$tekst="Obrisana vest sa id-jem ".$_POST['idvesti']." od strane ".$_SESSION['ime'];
			Logs::upisiUDatoteku("logs/vesti.txt", $tekst);
			echo "Obrisano vesti: ".$db->izmenjenoRedova()."<br><br>";
		}
	?>
	<form method="post" action="deletenews.php">
	
	<select name="idvesti">
	<option value="0" selected>--Izaberite vest--</option>
	<?php
	$upit="SELECT * FROM vesti where obrisan=0";
	$rez=$db->izvrsiUpit($upit);
	while($red=$db->procitajRed($rez))
		echo "<option value='$red->id'>$red->naslov</option>";
	?>
	</select><br><br>
	<input type="submit" value="Obriši vest" />
	</form>
	
	</div><!-- end #main -->
	
	
	
	<?php
	include("_footer.html");
?>
	
</div><!-- end #wrapper -->


</body>
</html>












