<?php
class Komentari
{
	public $db;
	public $idVesti;
	public $autor;
	public $tekst;

	public function __construct($db)
	{
		$this->db=$db;
	}
	public function upisUBazu($idVesti, $autor, $tekst)
	{
		$sql="INSERT INTO komentari (idVesti, autor, tekst) VALUES ($idVesti, '$autor', '$tekst')";
		// echo $sql; // to sto echo-uje prekopiram u upit u bazi i isprobam...
		mysqli_query($this->db, $sql);
	}
	static function prikaziSveKomentare($db, $idVesti)
	{
		$sql="SELECT * FROM komentari WHERE idVesti=$idVesti ORDER BY id desc";
		$result=mysqli_query($db, $sql);
		if(mysqli_num_rows($result)==0)
			echo "Nije postavljen ni jedan komentar!!!!<br>Budite prvi!!!<br>";
		else
		{
			while($red=mysqli_fetch_object($result))
			{
				echo "<hr>";
				echo "<b>$red->autor</b> - $red->datum<br>";
				echo $red->tekst."<br>";
				echo "voli me: <b><font color='green'>$red->volime</font></b>, ne voli me: <b><font color='red'>$red->nevolime</font></b>";
			}
		}
	}
}