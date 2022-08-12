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
	if(isset($_POST['id']))
	{
		$id=$_POST['id'];
		$naslov=$_POST['naslov'];
		$sadrzaj=$_POST['sadrzaj'];
		$kategorija=$_POST['kategorija'];
		$upit="UPDATE vesti set naslov='{$naslov}', sadrzaj='{$sadrzaj}', kategorija={$kategorija} WHERE id=$id";
		$db->izvrsiUpit($upit);
		$imeSlike="";
		if($_FILES['slikavesti']['name']!="")
		{
			if($_FILES['slikavesti']['size']<1000000)
			{
				$ekstenzija=pathinfo($_FILES['slikavesti']['name'], PATHINFO_EXTENSION);
				$imeSlike=time().".".$ekstenzija;
				@move_uploaded_file($_FILES['slikavesti']['tmp_name'], "../images/".$imeSlike);
				$upit="UPDATE vesti set slikavesti='{$imeSlike}' WHERE id=$id";
				$db->izvrsiUpit($upit);
			}else
				echo "Prevelika slika";
		}
		echo "Izmenjeno redova: ".$db->izmenjenoRedova()."<br><br>";
	}
	?>
	
		
	
	<form method="post" action="updatenews.php">
	<select name="idVesti">
	<option value="0" selected>--Izaberite vest za izmenu--</option>
	<?php
	$upit="SELECT * FROM vesti order by id desc";
	$rez=$db->izvrsiUpit($upit);
	while($red=$db->procitajRed($rez))
		echo "<option value='$red->id'>$red->naslov</option>";
	?>
	</select><br><br>
	<input type="submit" value="Izaberite vest"/>
	</form><br><hr>
	<?php
	$id="";
	$naslov="";
	$sadrzaj="";
	$kategorija="";
	$slikavesti="";
	if(isset($_POST['idVesti']) and $_POST['idVesti']!="0")
	{
		$id=$_POST['idVesti'];
		$upit="SELECT * FROM vesti WHERE id=$id";
		$rez=$db->izvrsiUpit($upit);
		$red=$db->procitajRed($rez);
		$id=$red->id;
		$naslov=$red->naslov;
		$sadrzaj=$red->sadrzaj;
		$kategorija=$red->kategorija;
		$slikavesti=$red->slikavesti;
		
		echo $red->id."<br>";
		echo $red->naslov."<br>";
		echo $red->sadrzaj."<br>";
		echo $red->autor."<br>";
		echo $red->vreme."<br>";
		echo $red->kategorija."<br>";
		echo $red->slikavesti."<br>";
	}
	?>
	<form method="post" action="updatenews.php" enctype="multipart/form-data">
	<input type="text" name="id" placeholder="ID" readonly="readonly" value="<?=$id?>"/><br><br>
	<input type="text" name="naslov" placeholder="Unesite naslov" value="<?=$naslov?>"/><br><br>
	<textarea name="sadrzaj" cols="30" rows="5" placeholder="Unesite sadrzaj"><?=$sadrzaj?></textarea><br><br>
	<select name="kategorija">
	<?php
	$upit="SELECT * FROM kategorija";
	$rez=$db->izvrsiUpit($upit);
	while($red=$db->procitajRed($rez))
	{
		if($kategorija==$red->id)
			echo "<option value='$red->id' selected>$red->naziv</option>";
		else
			echo "<option value='$red->id'>$red->naziv</option>";
	}
	?>
	</select><br><br>
	<?php
	if($slikavesti!="") echo "<img src='../images/$slikavesti' width=200px'/><br><br>";
	
	?>
	<input type="file" name="slikavesti"/><br><br>
	<input type="file" name="slikaVesti"/><br><br>
	
	<input type="submit" value="Izmenite vest"/>
	</form>
	</div><!-- end #main -->
	
	
	
<?php
	include("_footer.html");
?>
	
</div><!-- end #wrapper -->


</body>
</html>












