<?php
session_start();
ob_start();
require_once("../klase/classBaza.php");
require_once("../klase/classLogs.php");
require_once("funkcije.php");
$db=new Baza();
if(isset($_GET['logout']))
{
	@session_start();
	Logs::upisiUDatoteku("logs/logovanje.txt", "Odjava korisnika ".$_SESSION['ime']);
	if(isset($_SESSION['id']))unset($_SESSION['id']);
	if(isset($_SESSION['kor_id']))unset($_SESSION['kor_id']);
	session_destroy();
}
?>
<!doctype html>
<html lang="sr-RS">
<head>
<meta charset="utf-8">
<title>Vesti</title>

<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i&amp;subset=latin-ext" rel="stylesheet">

<link href="../fa/css/font-awesome.min.css" type="text/css" rel="stylesheet">

<link href="../css/style.css" type="text/css" rel="stylesheet">
<script src="../jquery-3.3.1.js"></script>
<script>
$(document).ready(function(){
	
	$("#dugme").click(function(){
		var email=$("#email").val();
		var lozinka=$("#lozinka").val();
		if(email=="" || lozinka=="")
		{
			$("#rezultat").html("<span style='color:red'>Niste uneli sve podatke</span>");
			return false;
		}
		if(email.search("=")>-1 || lozinka.search("=")>-1 || email.search(" ")>-1 || lozinka.search(" ")>-1)
		{
			$("#rezultat").html("<span style='color:red'>email ili lozinka sadrže nedozvoljene karaktere</span>");
			return false;
		}
		$.post("ajax.php?funkcija=prijava", {email:email,lozinka:lozinka},function(odgovor){
			if(odgovor.search(".php")>-1)
				window.location.assign(odgovor);
			else
				$("#rezultat").html(odgovor);
		});
	});
});
</script>
</head>

<body>

<div id="wrapper">
	
	<div id="header">
	
		<div id="logo">
			<img src="slike/logo.jpg" alt="sindja"></div>
		
	
	</div><!-- end #header -->
	
	<div id="nav">
	
		<ul>
			<li><a href="../index.php">Povratak na sajt</a></li>		
	       
	</div><!-- end #nav -->
	
	<div id="main">
	<?php
	if(isset($_POST['email']) AND isset($_POST['lozinka']))
	{
		$email=$_POST['email'];
		$lozinka=$_POST['lozinka'];
		if($email!="" and $lozinka!="")
		{
			if(proveraStringa($email) and proveraStringa($lozinka))
			{
				$upit="SELECT * FROM korisnici WHERE email='{$email}' AND lozinka='{$lozinka}'";
				$rez=$db->izvrsiUpit($upit);
				if($db->brojRedova($rez)==1)
				{
					echo "Uspešno logovanje<br><br>";
					session_start();
					$red=$db->procitajRed($rez);
					$_SESSION['email']=$red->email;
					$_SESSION['status']=$red->status;
					$_SESSION['ime']=$red->ime." ".$red->prezime;
					$_SESSION['id']=$red->id;
					$tekst="uspesna prijava korisnika".$red->ime."".$red->prezime;
					Logs::upisiUDatoteku("Logs/logovanje.txt",$tekst);
					header("location: pocetna.php");
					ob_end_flush();
					exit();
					
				}else
					echo "<font color='red'>Korisnik ne postoji</font><br><br>";
			}else
				echo "<font color='red'>Neki od podataka sadrže nedozvoljene karaktere</font><br><br>";
		}else
			echo "<font color='red'>Niste uneli sve podatke</font><br><br>";
			
	}
	?>
	<form action="index.php" method="post" id="formaZaLogovanje" name="formaZaLogovanje">
	<input type="text" id="email" name="email" placeholder="Unesite email"/><br><br>
	<input type="text" id="lozinka" name="lozinka" placeholder="Unesite lozinku"/><br><br>
	<input type="button" id="dugme" value="Prijavite se" onclick="proveriFormu();"/>
	</form>
	
	</div><!-- end #main -->
	<div id="sidebar">
	


	</div><!-- end #sidebar -->
	<div id="footer">
		<p>Copyright &copy; Vesti 2018</p>
	</div><!-- end #footer -->
	
</div><!-- end #wrapper -->


</body>
</html>

<script>
var brojPokusaja=0;
function proveriFormu()
{
	brojPokusaja++;
	if(brojPokusaja>3)
	{
		alert("Nemate više pokušaja!!!");
		document.getElementById("dugme").disabled=true;
		return false;
	}
	var email=document.getElementById("email");
	var lozinka=document.getElementById("lozinka");
	if(email.value=="")
	{
		alert("Niste uneli email adresu!!!\nImate još "+(3-brojPokusaja)+" pokusaja");
		email.focus();
		return false;
	}
	if(lozinka.value=="")
	{
		alert("Niste uneli lozinku!!!\nImate još "+(3-brojPokusaja)+" pokusaja");
		lozinka.focus();
		return false;
	}
	document.formaZaLogovanje.submit();
}
</script>












