<?php
session_start();
$funkcija=$_GET['funkcija'];
$db=mysqli_connect("localhost", "root", "", "sindjina_deca");
mysqli_query($db,"SET NAMES utf8");
switch($funkcija)
{
	case 'prijava':
		echo prijava($db);
	break;
	
}

function prijava($db)
{
	$email=$_POST['email'];
	$lozinka=$_POST['lozinka'];
	
	//provera email i lozinke
	$upit="SELECT * FROM korisnici WHERE email='{$email}' AND lozinka='{$lozinka}'";
	$rez=mysqli_query($db, $upit);
	if(mysqli_num_rows($rez)==0)
	{
		return "Korisnik ne postoji";
		//exit();
	}
	$red=mysqli_fetch_object($rez);
	$_SESSION['email']=$red->email;
	$_SESSION['status']=$red->status;
	$_SESSION['ime']=$red->ime." ".$red->prezime;
	if($red->status=="Administrator" || $red->status=="Urednik")
	{
		$_SESSION['id']=$red->id;
		if($red->status=="Administrator")
			return "Pocetna.php";
		else 
			return "addnews.php";
	}
	else
	{
		if($red->validan!=1)
		{
			return "Postoji korisnik, ali mejl nije potvrđen!!!";
		}
		
			
	}
	
	
}


?>