<?php
class Logs
{
	public static function upisiUDatoteku($imeDatoteke, $tekst)
	{
		$tekst=date("d.m.Y H:i:s", time()).": ".$tekst."\r\n";
		$f=fopen($imeDatoteke, "a");
		fwrite($f, $tekst);
		fclose($f);
	}
	
	public static function procitajIzDatoteke($imeDatoteke)
	{
		$tekst=file_get_contents($imeDatoteke);
		$tekst=str_replace("\r\n", "<br>", $tekst);
		return $tekst;
	}
}
?>