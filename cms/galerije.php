<?php
session_start();
require_once("../klase/classBaza.php");
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
		echo "Dobro došli, ".$_SESSION['ime'].". Prijavljeni ste kao ".$_SESSION['status']."<br><br>";
	?>
	<form action="" method="post">
	<input type="text" name="nazivGalerije" placeholder="Unesite naziv galerije" /><br><br>
	<textarea name="komentar" cols="30" rows="5" placeholder="Unesite komentar"></textarea><br><br>
	<input type="submit" value="Dodajte galeriju" />
	</form>
	<?php
		if(isset($_POST['nazivGalerije']))
		{
			$nazivGalerije=$_POST['nazivGalerije'];
			$komentar=$_POST['komentar'];
			if($nazivGalerije!="")
			{
				$upit="INSERT INTO galerije (nazivGalerije, komentar, autor) VALUES ('{$nazivGalerije}', '$komentar', ".$_SESSION['id'].")";
				$db->izvrsiUpit($upit);
				if($db->izmenjenoRedova()==1)
					echo "<br>Uspešno dodata galerija<br>";
				else
					echo "<br>Greška prilikom dodavanja galerije<br>".$db->greska();
			}
			else
				echo "<br>Niste uneli naziv galerije!!!<br>";
		}
	?>
	<hr><br>
	<form action="" method="post" enctype="multipart/form-data">
	<select name="idGalerije">
	<option value="0" selected>--Izaberite galeriju--</option>
	<?php
	$upit="SELECT * FROM galerije order by vreme desc";
	$rez=$db->izvrsiUpit($upit);
	while($red=$db->procitajRed($rez))
		echo "<option value='$red->id'>$red->nazivGalerije</option>";
	?>
	</select><br><br>
	<input type="file" name="slika1" />
	<input type="text" name="komentar1" placeholder="Unesite komentar"/><br>
	<input type="file" name="slika2" />
	<input type="text" name="komentar2" placeholder="Unesite komentar"/><br>
	<input type="file" name="slika3" />
	<input type="text" name="komentar3" placeholder="Unesite komentar"/><br>
	<input type="file" name="slika4" />
	<input type="text" name="komentar4" placeholder="Unesite komentar"/><br>
	<input type="file" name="slika5" />
	<input type="text" name="komentar5" placeholder="Unesite komentar"/><br><br>
	<input type="submit" value="Dodaj sliku"/>
	</form>
	<?php
	if(isset($_POST['idGalerije']))
	{
		$idGalerije=$_POST['idGalerije'];
		if($idGalerije!=0)
		{
			for($i=1;$i<=count($_FILES); $i++)
			{
				if($_FILES['slika'.$i]['name']!="")
				{
					$komentar=$_POST['komentar'.$i];
					$ekstenzija=pathinfo($_FILES['slika'.$i]['name'], PATHINFO_EXTENSION);
					$imeSlike=microtime(true).".".$ekstenzija;
					if(move_uploaded_file($_FILES['slika'.$i]['tmp_name'],"../galerije/".$imeSlike))
					{
						$upit="INSERT INTO galerijeslike (idGalerije, slika, komentar) VALUES ({$idGalerije}, '{$imeSlike}', '{$komentar}')";
						$db->izvrsiUpit($upit);
						
					}else
						echo "<br>Nije uspeo upload slike ".$_FILES['slika'.$i]['name'];
					
				}
			}
			
			
		}
		else
			echo "<br>Niste izabrali nijednu galeriju!!!<br>";
	}
	?>
	<hr><br>
	<h3>Upload više datoteka</h3>
	<form action="" method="post" enctype="multipart/form-data">
	<select name="idGalerijeMultiple">
	<option value="0" selected>--Izaberite galeriju--</option>
	<?php
	$upit="SELECT * FROM galerije order by vreme desc";
	$rez=$db->izvrsiUpit($upit);
	while($red=$db->procitajRed($rez))
		echo "<option value='$red->id'>$red->nazivGalerije</option>";
	?>
	</select><br><br>
	<input type="file" name="slike[]" multiple="multiple" /><br>
	<br>
	<input type="submit" value="Dodaj slike"/>
	</form>
	<?php
	if(isset($_POST['idGalerijeMultiple']))
	{
		$idGalerije=$_POST['idGalerijeMultiple'];
		if($idGalerije!=0)
		{
			//echo count($_FILES['slike']['name']);
			for($i=0;$i<count($_FILES['slike']['name']); $i++)
			{
				if($_FILES['slike']['name'][$i]!="")
				{
					//$komentar=$_POST['komentar'.$i];
					$ekstenzija=pathinfo($_FILES['slike']['name'][$i], PATHINFO_EXTENSION);
					$imeSlike=microtime(true).".".$ekstenzija;
					if(move_uploaded_file($_FILES['slike']['tmp_name'][$i],"../galerije/".$imeSlike))
					{
						$upit="INSERT INTO galerijeslike (idGalerije, slika) VALUES ({$idGalerije}, '{$imeSlike}')";
						$db->izvrsiUpit($upit);
						
					}else
						echo "<br>Nije uspeo upload slike ".$_FILES['slike']['name'][$i];
					
				}
			}
		}else
			echo "Niste izabrali galeriju!!!!<br>";
	}
	?>
	</div><!-- end #main -->
	
<?php
	include("_footer.html");
?>
	
	
</div><!-- end #wrapper -->


</body>
</html>












