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
    <?php include_once "inc/favicon.html" ?>
</head>

<body>
<div id="wrapper">
	<header id="header" class="cl">
		<?php include('inc/nav.php') ?>
	</header> <!--end #header-->
	
	<div id="main" class="cl">
		<form method="post" action="#" enctype="multipart/form-data">
			<input type="text" name="naslov" id="naslov" placeholder="Unesite naslov"><br><br>
			<textarea cols=50 rows=8 name="sadrzaj" id="sadrzaj" placeholder="Unesite sadržaj..." ></textarea><br><br>
			<select name="kategorija" id="kategorija">
                <?php // ovde izlistava kao opcije selecta iz baze!!!
                $db=konekcija();
                $sql="SELECT * FROM kategorije";
                $result=mysqli_query($db,$sql);
                while ($red=mysqli_fetch_object($result))
                {
                    echo "<option value='$red->id'>$red->naziv</option>";
                }
                ?>
			</select><br><br>
			<input type="file" name="datoteka" id="datoteka"><br><br>
			<input type="submit" value="Snimi vest!">
		</form>
		<?php
		// print_r($_FILES); echo "<br>"; // prikazuje sta dobijam od file prilikom uploada
		// rad sa datotekom
		if(isset($_FILES['datoteka']['name']) and $_FILES['datoteka']['name']!="")
		{
			if($_FILES['datoteka']['size']>6000000)
			{
				echo "Datoteka prelazi dozvoljenu velicinu!!!";
				exit();				
			}
			$ime=$_FILES['datoteka']['name']; // ime datoteke
			$tip=pathinfo($ime, PATHINFO_EXTENSION); // PATHINFO_EXTENSION vraca samo tip extenzije, moglo je sa getimagesize() da se proveri tip datoteke
			if($tip!="jpg" and $tip!="bmp" and $tip!="png" and $tip!="gif")
			{
				echo "Nije dobar tip datoteke!!!";
				exit();
			}
			$check=getimagesize($_FILES['datoteka']['tmp_name']); 
			// print_r($check) // pokaze kakva je slika, dimenzije tip itd....
			if($check[0]>2000 or $check[1]>2000) // ako je slika veca od 2000px sirine i visine ne dozvoljava upload!
			{
				echo "Slika je veceg formata nego sto je dozvoljeno!";
				exit();
			}
			$novoime=$_SESSION['korime']."_".date("Y.m.d-G.i.s",time()).".".pathinfo($_FILES['datoteka']['name'], PATHINFO_EXTENSION); //seassion od korime pa datum kakav hocu pa pathinfo dodaje extenziju .jpg .png ili koja je vec extenzija toga sto uploadujemo!
			if(@!move_uploaded_file($_FILES['datoteka']['tmp_name'], "imagesFromNews/".$novoime)) // ako ne uspe prenos (folder je drugacijeg imena itd) obavesti ovo i izbaci error
			{
				echo "Nije uspeo prenos datoteke!";
				exit();
			}
			
		}
		// rad sa ostalim poljima
		if(!empty($_POST['naslov']) and !empty($_POST['sadrzaj']) and !empty($_POST['kategorija']) and !empty($_FILES['datoteka']['name']))
		{
			$naslov=trim(htmlentities($_POST['naslov'], ENT_QUOTES));
            $sadrzaj=trim(htmlentities($_POST['sadrzaj'], ENT_QUOTES));
			$napisao=$_SESSION['ime'];
			$kategorija=$_POST['kategorija'];
			$db=konekcija();
			$slika=$novoime;
			$sql="INSERT INTO lineweb (naslov, sadrzaj, autor, id_kategorije, slika) VALUES ('$naslov','$sadrzaj','$napisao','$kategorija','$slika')";
			mysqli_query($db, $sql);
			if(mysqli_error($db))
				echo "<span style='color:red'>Neuspesno dodavanje zapisa!!! Greska: ".mysqli_error($db)."</span><br>"; // izbacuje gresku ako ne postoji kategorija ili je nesto pogresno upisano u bazu
			else
			{
				echo "Uspesno dodata vest!!!<br>";
				echo "<a href='news.php'>Povratak na NEWS!!!</a>";
				$obj=new Log("Uspesno dodata vest $naslov od korisnika: ".$_SESSION['korime']);
				$obj->upisVesti();
			}
		}
		else
			echo "<span style='color:red'>Unesite sve podatke!<br></span>";
		
		// UBACI SLIKU U FOLDER ALI NE UPISE ZAPIS U BAZU AKO DODJE DO NEKE GRESKE TIPA SQL INJECTION!!! NAJBOLJE BI BILO DA SE POSTAVI USLOV IF(MOVE_UPLOADED_FILE){ONDA UPISE U BAZU} dakle ako ubaci sliku na server onda upise i u bazu tu informaciju....
		?>
	</div>
	<footer id="footer">
		<p>Copyright &copy; Lineweb</p>
	</footer> <!--end #footer-->

</div> <!-- end of wrapper -->
</body>
</html>
