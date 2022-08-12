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
			echo "Dobro došli, ".$_SESSION['ime'].". Prijavljeni ste kao ".$_SESSION['status']."<br>";
		?>
	
	
	</div><!-- end #main -->
	
	<?php
	include("_footer.html");
?>
	
	
	
</div><!-- end #wrapper -->


</body>
</html>












