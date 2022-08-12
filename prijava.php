<form action="#" method="post">
<input type="text" name="email" placeholder="unesite email"/><br>
<input type="text" name="lozinka" placeholder="unesite lozinka"/><br>
<input type="submit" value="Prijavi se"/>
</form>
<?php
if(isset($_POST['email']) and isset($_POST['lozinka']))
{
	$email=$_POST['email'];
	$lozinka=$_POST['lozinka'];
	$db=mysqli_connect("localhost", "root", "", "novine_vesti");
	if(mysqli_connect_error())
	{
		echo "Doslo je do greske prilikom konekcije na bazu<br>".mysqli_connect_error();
		exit();
	}
	mysqli_query($db, "SET NAMES utf8");
	$upit="SELECT * FROM korisnici WHERE email='{$email}' and lozinka='{$lozinka}'";
	$rez=mysqli_query($db, $upit);
	if(mysqli_num_rows($rez)==1)
	{
		$red=mysqli_fetch_assoc($rez);
		echo $red['id'].": ".$red['ime']." ".$red['prezime']." [".$red['status']."] <br>Datum kreiranja naloga ".$red['vreme']."<br>";
	}
	else
		echo "Ne postoji korisnik sa tim emejlom i lozinkom<br>";
}
?>