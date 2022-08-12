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
		if(isset($_POST['idkorisnika']) and $_POST['idkorisnika']!="0")
		{
			$upit="DELETE FROM korisnici WHERE id=".$_POST['idkorisnika'];
			$db->izvrsiUpit($upit);
			$tekst="Obrisan korisnik  sa id-jem ".$_POST['idkorisnika']." od strane ".$_SESSION['ime'];
			Logs::upisiUDatoteku("logs/korisnici.txt", $tekst);
			echo "Obrisano korisnika: ".$db->izmenjenoRedova()."<br><br>";
		}
	?>
	<form method="post" action="deleteuser.php">
	
	<select name="idkorisnika">
	<option value="0" selected>--Izaberite korisnika--</option>
	<?php
	$upit="SELECT * FROM korisnici";
	$rez=$db->izvrsiUpit($upit);
	while($red=$db->procitajRed($rez))
		echo "<option value='$red->id'>$red->ime $red->prezime</option>";
	?>
	</select><br><br>
	<input type="submit" value="Obriši korisnika" />
	</form>
	
	</div><!-- end #main -->
	
	
	
	<?php
	include("_footer.html");
?>
	
</div><!-- end #wrapper -->


</body>
</html>












