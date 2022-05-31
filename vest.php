<?php // STRANICA NE VALJA ZATO STO AKO NE PROSLEDIM ID IZBACUJE TONU GRESAKA
require_once("funkcije.php");
require_once("class_Komentari.php");
session_start();
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
		<div id="kategorije">
			<a href="news.php">Sve vesti</a>
			<?php // ovde izlistava kategorije vesti iz funkcije!!!
			$db=konekcija();
			prikaziMeniKategorija($db);
			?>
		</div>
		<div id="sadrzaj">
			<?php
			$db=konekcija();
			if(isset($_GET['id']) and is_numeric($_GET['id'])) //ako je parametar koji dobijam $_GET['id'] sa news.php onda radi ovo ako nije onda redirektuj na news opet (nema sada da neki kuca svasta u URL umesto broja za get)
			{
//				$sql="SELECT * FROM lineweb WHERE id=".$_GET['id'];
				$sql="SELECT * FROM lineweb join kategorije WHERE id_kategorije=kategorije.id AND lineweb.id=".$_GET['id'];
				$result=mysqli_query($db, $sql);
				if(mysqli_num_rows($result)==0) //ako je odgovor od baze 0 znaci da ne postoji vest sa takvim id-jem
				{
					echo "Ne postoji vest sa ID-jem ".$_GET['id']."!!!!!";
					exit();
				}
				while($red=mysqli_fetch_assoc($result))
				{
					// OVO JE JEDNA VEST 
					if(isset($_GET['id'])) // ako je setovan id onda echuje tu vest
					{
						echo "<h1>".$red['naslov']."</h1>";
						echo "<i>Kategorija: ".$red['naziv']."</i>";
						if($red['slika']!="")
						{
							echo "<img class='slikavesti cl' src='imagesFromNews/".$red['slika']."' alt='".$red['slika']."'>";
						}
						echo "<p>".$red['sadrzaj']."</p>";
						echo $red['datum']." - ".$red['autor']."<br>";
					}
				}
			}
			else header("Location:news.php");
			?>
		</div>
		<!--Forma za postavljanje komentara-->
		<div id="komentari">
			<form action="vest.php?id=<?=$_GET['id']?>" method="post">
			<input type="text" name="autor" id="autor" placeholder="Autor"><br><br>
			<textarea name="tekst" id="tekst" placeholder="Unesite vas komentar"></textarea><br><br>
			<input type="submit" value="Snimi komentar">
			</form><br>
			
			<?php
			$db=konekcija();
			$id=$_GET['id'];
			if(isset($_POST['autor']) AND isset($_POST['tekst']))
			{
				$autor=$_POST['autor'];
				$tekst=$_POST['tekst'];
				if($autor!="" and $tekst!="")
				{
					$obj=new Komentari($db);
					$obj->upisUBazu($id, $autor, $tekst);
				}
			}
			Komentari::prikaziSveKomentare($db, $id);
			?>
		</div>
	</div> <!--end #main-->
	
		
		<?php
		if(isset($_SESSION['ime'])) // ako si loginovan setovana je sesija i onda vidis "dodajvest" i "izmeni vest" linkove!
		{
			$dodajvest='<aside id="sidebar" class="cl">';
			$dodajvest.='<div class="block">';
			$dodajvest.='<h2><a href="novavest.php">Dodaj vest</a></h2>';
			$dodajvest.='<h2><a href="izmenivest.php">izmeni vest</a></h2>';
			$dodajvest.='</div>';
			echo $dodajvest;
		}
		mysqli_close($db);
		?>
		
	</aside> <!--end #sidebar-->
	<footer id="footer">
		<p>Copyright &copy; Lineweb</p>
	</footer> <!--end #footer-->

</div> <!-- end of wrapper -->
</body>
</html>
