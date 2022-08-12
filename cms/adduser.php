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
			echo "Dobro došli, ".$_SESSION['ime']." (".$_SESSION['status'].")<br>";
			
			echo "<h2>Dodavanje korisnika</h2>";
			if(isset($_POST['ime']) and $_POST['ime']!="")
			{
				$ime=$_POST['ime'];
				$prezime=$_POST['prezime'];
				$email=$_POST['email'];
				$lozinka=$_POST['lozinka'];
				$potvrdalozinke=$_POST['potvrdalozinke'];
				$status=$_POST['status'];
				$imeSlike="";
				if($_FILES['avatar']['name']!="")
				{
					if($_FILES['avatar']['size']<100000)
					{
						$ekstenzija=pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
						$imeSlike=time().".".$ekstenzija;
						@move_uploaded_file($_FILES['avatar']['tmp_name'], "slike/".$imeSlike);
					}else
						echo "Prevelika slika";
					
				}
				if($lozinka==$potvrdalozinke)
				{
					$upit="INSERT INTO korisnici (ime, prezime,  lozinka, email, status, slika) VALUES ('{$ime}', '{$prezime}', '{$lozinka}', '{$email}', '{$status}', '{$imeSlike}')";
					//echo $upit;
					$db->izvrsiUpit($upit);
					/*if(mysqli_error($db))
						echo "Greska!!!<br>".mysqli_error($db);
					else*/
					echo "Dodato korisnika: ".$db->izmenjenoRedova()."<br><br>";
					$tekst="Dodat korisnik $ime $prezime ($email)od strane ".$_SESSION['ime'];
					Logs::upisiUDatoteku("logs/korisnici.txt", $tekst);
				}else
					echo "Lozinka i potrda lozinke nisu iste<br><br>";
			}
		?>
	<form method="post" action="adduser.php" enctype="multipart/form-data">
	<input type="text" name="ime" placeholder="Unesite ime" /><br><br>
	<input type="text" name="prezime" placeholder="Unesite prezime" /><br><br>
	<input type="text" name="email" placeholder="Unesite email" /><br><br>
	<input type="text" name="lozinka" placeholder="Unesite lozinku" /><br><br>
	<input type="text" name="potvrdalozinke" placeholder="Potvrdite lozinku" /><br><br>
	<input type="file" name="avatar"/><br><br>
	<select name="status">
	<option value="Administrator" selected>Administrator</option>
	<option value="Urednik" >Urednik</option>
	</select><br><br>
	<input type="submit" value="Dodaj korisnika" />
	</form>
	
	</div><!-- end #main -->
	
	
	
	<?php
	include("_footer.html");
?>
	
</div><!-- end #wrapper -->


</body>
</html>












