<?php
if(isset($_POST['ime']) && isset($_POST['email']))
{
$ime=$_POST['ime'];
$prezime=$_POST['prezime'];
$email=$_POST['email'];
$lozinka=$_POST['lozinka'];
$grad=$_POST['grad'];
$vremeprijave=time();
	$db=mysqli_connect("localhost", "root", "", "novine_vesti");
	mysqli_query($db, "SET NAMES UTF8");
	$upit="INSERT INTO korisnici (ime, prezime, email, lozinka, grad, status, validan) VALUES ('{$ime}', '{$prezime}', '{$email}', '{$lozinka}','{$grad}','Korisnici', {$vremeprijave})";
	mysqli_query($db, $upit);
	if(mysqli_error($db))
		
		echo "Doslo je do greske:<br>".mysqli_error($db);
	else
	{	echo "Link za potvrdu registracije je:<br><a href='http://localhost/proba/sindjinadeca/potvrda.php?email=$email&validan=$vremeprijave'target='_blank'>potvrda.php?email=$email&validan=$vremeprijave</a>";
	@mail($email,"Potvrda registracije",$poruka);
		
			//echo $poruka;
	}
}
else
	echo "Nisu poslati svi podaci";

?>