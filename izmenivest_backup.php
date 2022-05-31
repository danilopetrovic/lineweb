<?php
require_once("funkcije.php");
require_once("admin/class_Log.php");
session_start();
if(!isset($_SESSION['ime']))
{
	header('Location:admin/login.php');
	exit();
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Lineweb2</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i&amp;subset=latin-ext" rel="stylesheet">
<meta name="viewport" content="width=device-width">
</head>

<body>
<div id="wrapper">
	<header id="header" class="cl">
		<?php include('inc/nav.php') ?>
	</header> <!--end #header-->
	
	<div id="main" class="cl">
	
		<!-- forma za izbor vesti -->
		<form action="#" method="post">
		<select name="idVesti" id="idVesti">
			<option>Izaberite vest iz padajuceg menija</option>
			<option>----------------------------------</option>
			<?php
			$db=konekcija();
			//ako je administrator onda moze da menja svacije vesti a ako je urednik(korisnik) onda moze da menja samo svoje vesti!
			if($_SESSION['status']=="Administrator")
				$sql="SELECT id, naslov FROM lineweb WHERE obrisan=0 ORDER BY id DESC";
			else
				$sql="SELECT id, naslov FROM lineweb WHERE obrisan=0 AND autor='".$_SESSION['ime']."' ORDER BY datum DESC";
			$result=mysqli_query($db,$sql);
			while($red=mysqli_fetch_object($result))
				echo "<option value='".$red->id."'>".$red->naslov."</option>"; //id mora da bude pod navodnicima zbog forme...
			mysqli_close($db);
			?>
		</select><br>
		<input type="submit" value="Izaberite vest">
		</form>
		<hr>
		<!-- forma za izmenu vesti -->
		<?php
		$id="";
		$naslov="";
		$sadrzaj="";
		$kategorija="";
		$slika="";
		//ako je prosledjen parametar get id od vesti sa news.php stranice i sesija je administrator onda selektuje tu vest, popuni polja i mozes da je menjas a ako nisi admin mozes da kucas link i ne povlaci se iz baze..
		if(isset($_GET['id']) and is_numeric($_GET['id']) and isset($_SESSION['ime']) and $_SESSION['status']=="Administrator") // uslov da menja vest administrator
		{
			$id=$_GET['id'];
			$db=konekcija();
			$sql="SELECT * FROM lineweb WHERE id=$id";
			$result=mysqli_query($db, $sql);
			$red=mysqli_fetch_object($result);
			if(mysqli_num_rows($result)==1) //ako je odgovor baze 1 od onoga sto smo prosledili getom, onda se ubaci ta vest u polja...
			{
				$id=$red->id;
				$naslov=$red->naslov;
				$sadrzaj=$red->sadrzaj;
				$kategorija=$red->kategorija;
				$slika=$red->slika;
			}
		}
		
		// if(isset($_GET['id']) and is_numeric($_GET['id']) and isset($_SESSION['ime']) and $_SESSION['status']=="Administrator") // uslov da menja vest urednik 
		// {
			// $id=$_GET['id'];
			// $db=konekcija();
			// $sql="SELECT * FROM lineweb WHERE id=$id";
			// $result=mysqli_query($db, $sql);
			// $red=mysqli_fetch_object($result);
			// if(mysqli_num_rows($result)==1) //ako je odgovor baze 1 od onoga sto smo prosledili getom, onda se ubaci ta vest u polja...
			// {
				// $id=$red->id;
				// $naslov=$red->naslov;
				// $sadrzaj=$red->sadrzaj;
				// $kategorija=$red->kategorija;
				// $slika=$red->slika;
			// }
		// }
		
		
		if(isset($_POST['idVesti']) and is_numeric($_POST['idVesti'])) // ako je setovan i ako je numericki idVesti onda radi fetch i smesta u promenljive! numeric zato sto izbacuje gresku kada se prosledi prazan podatak za prve 2 opcije "izaberi vest iz padajuceg menija" i "------------------"! moze i na option da im se stavi value="0" pa da se umesto is_numeric pita $_POST['idVesti']!=0
		{
			$id=$_POST['idVesti'];
			$db=konekcija();
			$sql="SELECT * FROM lineweb WHERE id=$id";
			$result=mysqli_query($db, $sql);
			$red=mysqli_fetch_object($result);
			$id=$red->id;
			$naslov=$red->naslov;
			$sadrzaj=$red->sadrzaj;
			$kategorija=$red->kategorija;
			$slika=$red->slika;
		}
		?>
		<form method="post" action="#" enctype="multipart/form-data">
			<input type="text" name="idVest" id="idVest" value="<?=$id?>" placeholder="ID vesti" hidden>
			<input type="text" name="naslov" id="naslov" value="<?=$naslov?>"><br><br>
			<textarea cols=50 rows=8 name="sadrzaj" id="sadrzaj"><?=$sadrzaj?></textarea><br><br>
			iz "<?=$kategorija?>" promeni kategoriju u:
            <select name="kategorija" id="kategorija">
				<option value="<?=$kategorija?>" selected hidden><?=$kategorija?></option> <!--ovde sam stavio da je trenutna kategorija selektovana i u isto vreme sakrivena-->
				<option value="Sport">Sport</option>
				<option value="Hronika">Hronika</option>
				<option value="Zabava">Zabava</option>
				<option value="Politika">Politika</option>
				<option value="IT">IT</option>
			</select><br><br>
			<img src="imagesFromNews/<?=$slika?>" alt="<?=$slika?>"><br><br>
			<input type="file" name="datoteka" id="datoteka"><br><br>
			<input type="submit" value="Snimi vest!">
		</form>
		<?php
		if (isset($_POST['idVest']) and isset($_POST['naslov']) and isset($_POST['sadrzaj']) and isset($_POST['kategorija']))
		{
			$db=konekcija();
			$id=$_POST['idVest'];
			$naslov=$_POST['naslov'];
			$sadrzaj=$_POST['sadrzaj'];
			$kategorija=$_POST['kategorija'];
			if(isset($_FILES['datoteka']['name']) and $_FILES['datoteka']['name']!="")
			{
				$slika=$_SESSION['korime']."_".date("Y.m.d-G.i.s",time()).".".pathinfo($_FILES['datoteka']['name'], PATHINFO_EXTENSION);
				$sql="UPDATE lineweb SET slika='$slika' WHERE id=$id";
				move_uploaded_file($_FILES['datoteka']['tmp_name'], "imagesFromNews/".$slika);
				mysqli_query($db, $sql);
			}
			$sql="UPDATE lineweb SET naslov='$naslov', sadrzaj='$sadrzaj', kategorija='$kategorija' WHERE id=$id";
			mysqli_query($db, $sql);
			echo "<h2>Uspesno izmenjena vest!!!</h2>";
				$obj=new Log("Uspesno izmenjena vest: ".$_POST['naslov']." od korisnika ".$_SESSION['korime']);
				$obj->izmenaVesti();
		}
		?>
	</div>
	<footer id="footer">
		<p>Copyright &copy; Lineweb</p>
	</footer> <!--end #footer-->

</div> <!-- end of wrapper -->
</body>
</html>
