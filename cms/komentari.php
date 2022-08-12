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
		if(isset($_GET['akcija']) and isset($_GET['idKomentara']))
		{
			$akcija=$_GET['akcija'];
			$id=$_GET['idKomentara'];
			if($akcija=="dozvoli")
				$upit="UPDATE komentari SET dozvoljen=1 WHERE id=$id";
			if($akcija=="obrisi")
				$upit="DELETE FROM komentari WHERE id=$id";
			$db->izvrsiUpit($upit);
		}
		if($_SESSION['status']=="Administrator")
		{
			$upit="SELECT * FROM komentari WHERE dozvoljen =0";
			$rez=$db->izvrsiUpit($upit);
			if($db->brojRedova($rez)!=0)
			{
				while($red=$db->procitajRed($rez))
				{
					echo "<i>".$red->vreme."</i><br> <b>".$red->autor."</b><br>";
					echo $red->tekst."<br><br>";
					echo "<a href='komentari.php?akcija=dozvoli&idKomentara=$red->id'>Dozvoli</a> | ";
					echo "<a href='komentari.php?akcija=obrisi&idKomentara=$red->id'>Obriši</a><br><br>";
				}
			}else
			{
				echo "Nema nijedan komentar<br>";
			}
		}else
		{
			echo "Nemate pravo pristupa ovoj stranici<br>";
		}
		?>
	
	
	</div><!-- end #main -->
	
	
	
	<?php
	include("_footer.html");
?>
	
</div><!-- end #wrapper -->


</body>
</html>












