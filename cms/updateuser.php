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
	$id="";
		$ime="";
		$prezime="";
		$email="";
		$lozinka="";
		$komentar="";
		$status="";
		$slika="";
		if(isset($_POST['id']) and $_POST['id']!="")
		{
			$id=$_POST['id'];
			$ime=$_POST['ime'];
			$prezime=$_POST['prezime'];
			$email=$_POST['email'];
			$lozinka=$_POST['lozinka'];
			$komentar=$_POST['komentar'];
			$status=$_POST['status'];
			$upit="UPDATE korisnici SET ime='{$ime}', prezime='{$prezime}', email='{$email}', lozinka='{$lozinka}', komentar='{$komentar}', status='{$status}'";
			$db->izvrsiUpit($upit);
			$tekst="Izmenjen korisnik $ime $prezime($email) od strane ".$_SESSION['ime'];
			Logs::upisiUDatoteku("logs/korisnici.txt", $tekst);
		}
	?>
	
		
	
	<form method="post" action="updateuser.php">
	
	<select name="idkorisnika">
	<option value="0" selected>--Izaberite korisnika--</option>
	<?php
	$upit="SELECT * FROM korisnici";
	$rez=$db->izvrsiUpit($upit);
	while($red=$db->procitajRed($rez))
		echo "<option value='$red->id'>$red->ime $red->prezime</option>";
	?>
	</select><br><br>
	<input type="submit" value="Izaberi korisnika" />
	</form><br><br>
	<?php
		
		if(isset($_POST['idkorisnika']) and $_POST['idkorisnika']!="0")
		{
			$upit="SELECT * FROM korisnici WHERE id=".$_POST['idkorisnika'];
			$rez=$db->izvrsiUpit($upit);
			$red=$db->procitajRed($rez);
			$id=$red->id;
			$ime=$red->ime;
			$prezime=$red->prezime;
			$email= $red->email;
			$lozinka= $red->lozinka;
			$komentar= $red->komentar;
			$status= $red->status;
			$slika= $red->slika;
		}
	?>
	<form method="post" action="updateuser.php" enctype="multipart/form-data">
	<input type="text" name="id" placeholder="Unesite id" value="<?=$id?>"/><br><br>
	<input type="text" name="ime" placeholder="Unesite ime" value="<?=$ime?>"/><br><br>
	<input type="text" name="prezime" placeholder="Unesite prezime" value="<?=$prezime?>"/><br><br>
	<input type="text" name="email" placeholder="Unesite email" value="<?=$email?>"/><br><br>
	<input type="text" name="lozinka" placeholder="Unesite lozinku" value="<?=$lozinka?>"/><br><br>
	<textarea name="komentar" cols="30" rows="5"><?=$komentar?></textarea><br><br>
	<?php
	if($slika!="")
	{
		echo "<img src='slike/$slika' alt='slika' width='50px'/><br>";
	}
	else echo "<img src='slike/default.png' alt='slika' width='50px'/><br>";
	?>
	<input type="file" name="avatar"/><br><br>
	<select name="status">
	<option value="Administrator" selected>Administrator</option>
	<option value="Urednik" >Urednik</option>
	</select><br><br>
	<input type="submit" value="Izmeni korisnika" />
	</form>
	</div><!-- end #main -->
	
	
	
	<?php
	include("_footer.html");
?>
	
</div><!-- end #wrapper -->


</body>
</html>












