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
			echo "Dobro došli, ".$_SESSION['ime']." (".$_SESSION['status'].")<br>";
			
			echo "<h2>Dodavanje vesti</h2>";
			if(isset($_POST['naslov']) and $_POST['naslov']!="")
			{
				$naslov=$_POST['naslov'];
				$sadrzaj=$_POST['sadrzaj'];
				$kategorija=$_POST['kategorija'];
				
				$imeSlike="";
				if($_FILES['slikaVesti']['name']!="")
				{
					if($_FILES['slikaVesti']['size']<1000000)
					{
						$ekstenzija=pathinfo($_FILES['slikaVesti']['name'], PATHINFO_EXTENSION);
						$imeSlike=time().".".$ekstenzija;
						@move_uploaded_file($_FILES['slikaVesti']['tmp_name'], "../images/".$imeSlike);
					}else
						echo "Prevelika slika";
					
				}
				
					$upit="INSERT INTO vesti (naslov, sadrzaj,  kategorija, autor, slikavesti) VALUES ('{$naslov}', '{$sadrzaj}', '{$kategorija}', '".$_SESSION['id']."', '{$imeSlike}')";
				
					$db->izvrsiUpit($upit);
					if($db->greska())
						echo "Greska!!!<br>".mysqli_error();
					else
					{
						$tekst="Dodat vest sa naslovom $naslov od strane ".$_SESSION['ime'];
						Logs::upisiUDatoteku("logs/vesti.txt", $tekst);
						echo "Dodato vesti: ".$db->izmenjenoRedova()."<br><br>";
					}
						
				
			}
		?>
	<form method="post" action="addnews.php" enctype="multipart/form-data" id="forma" name="forma">
	<input type="text" name="naslov" placeholder="Unesite naslov" /><br><br>
	<textarea name="sadrzaj" placeholder="Unesite sadrzaj" cols='20' rows='10'></textarea><br><br>
	
	<input type="file" name="slikaVesti"/><br><br>
	<input type="file" name="slikaVesti"/><br><br>
	<input type="file" name="slikaVesti"/><br><br>
	<input type="file" name="slikaVesti"/><br><br>
	<input type="file" name="slikaVesti"/><br><br>
	<input type="file" name="slikaVesti"/><br><br>
	<input type="file" name="slikaVesti"/><br><br>
	<select id="kategorija" name="kategorija">
	<option value="0" selected>--Izaberite kategoriju--</option>
	<?php
	$upit="SELECT * FROM kategorija";
	$rez=$db->izvrsiUpit($upit);
	while($red=$db->procitajRed($rez))
		echo "<option value='$red->id'>$red->naziv</option>";
	?>
	</select><br><br>
	<input type="button" value="Dodaj vest" onclick="proveriFormu();"/>
	</form>
	
	</div><!-- end #main -->
	
	
	
	<?php
	include("_footer.html");
?>
	
</div><!-- end #wrapper -->


</body>
</html>
<script>
function proveriFormu()
{
	var kategorija=document.getElementById("kategorija");
	
	if(kategorija.value=="0")
	{
		alert("Niste uneli kategoriju!!!!");
		kategorija.focus();
		return false;
	}
	
	document.forma.submit();
}
</script>












