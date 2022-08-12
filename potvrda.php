<?php
if(isset($_GET['email']) && isset($_GET['validan']))
{
	$email=$_GET['email'];
	$potvrda=$_GET['validan'];
	//PROVERA PODATAKA
	$db=mysqli_connect("localhost", "root", "", "novine_vesti");
	mysqli_query($db, "SET NAMES UTF8");
	$upit="UPDATE korisnici SET validan=1 WHERE email='{$email}' AND validan={$potvrda}";
	echo $upit."<br>";
	$rez=mysqli_query($db, $upit);
	if(mysqli_affected_rows($db)==1)
		echo "Uspešna potvrda korisnika";
	else
		echo "Već ste se potvrdili";
}
else
	echo "Greška";
?>