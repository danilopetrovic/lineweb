<?php
require_once("funkcije.php");
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
<script src="admin/jquery-3.2.1.js"></script>
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
            <?php // ovde izlistava sve kategorije vesti iz funkcije!!!
            $db=konekcija();
            prikaziMeniKategorija($db);
            ?>
            <div id="divpretraga">
                <form action="#" method="get">
                    <input type="text" id="pretraga" name="pretraga" placeholder="pretraga po sadrzaju ili naslovu" style="width:200px;">
                    <input type="submit" value="pretraži">
                </form>
            </div>
        </div>
        <div id="sadrzaj">
            <div id="divproba"></div>
            <?php
			$sql="SELECT lineweb.*,kategorije.naziv FROM lineweb JOIN kategorije ON lineweb.id_kategorije=kategorije.id WHERE obrisan=0 ORDER BY datum DESC";
			if(isset($_GET['kategorija']))
			    $sql="SELECT lineweb.*, kategorije.naziv FROM lineweb JOIN kategorije ON lineweb.id_kategorije=kategorije.id WHERE obrisan=0 AND id_kategorije='".$_GET['kategorija']."' ORDER BY datum DESC";
			if(isset($_GET['id']))
			    $sql="SELECT lineweb.*,kategorije.naziv FROM lineweb JOIN kategorije ON lineweb.id_kategorije=kategorije.id WHERE lineweb.id=".$_GET['id'];
			/*pocetak pretrage koda*/
            if(isset($_GET['pretraga']))
            {
                if(provera($_GET['pretraga'])==false)
                {
                    echo "koristili ste nedozvoljene karaktere u pretrazi (*, +, -, =, ', \", {, }, ......)";
                    exit();
                }
                else
                {
                    $pretraga=$_GET['pretraga'];
                    $sql="SELECT lineweb.*,kategorije.naziv FROM lineweb JOIN kategorije ON lineweb.id_kategorije=kategorije.id WHERE naslov like '%$pretraga%' or sadrzaj like '%$pretraga%'";
                }
            }/*kraj pretrage*/
            $result=mysqli_query($db, $sql);
			while($red=mysqli_fetch_assoc($result))
			{
				// OVO SU VISE VESTI
				if(!isset($_GET['id'])) // ako nije setovan id onda prikazuje sve vesti
				{
                    if(isset($_GET['pretraga'])) /*ako je setovana pretraga onda da kaze koliko ima rezultata u tom upitu*/
                        echo "Broj rezultata pretrage je: ".mysqli_num_rows($result);
					echo '<div class="cl">'; /*ceo sadrzaj je u okviru diva koji ima clear klasu definisanu u css-u zbog floatovane slike desno (da nebi sadrzaj iz donje vesti upadao u gornju)*/
					echo "<a href=vest.php?id=".$red['id']."><h2>".$red['naslov']."</h2></a>"; /*naslov u obliku linka koji je linkovan sa id-om*/
					if($red['slika']!="")
					{
                        /*i slika je link ka vesti*/
						echo "<a href=vest.php?id=".$red['id']."><img class='malaslikavesti cl' src='imagesFromNews/".$red['slika']."'></a>";
					}
					echo "<p>".substr($red['sadrzaj'], 0, 150)."</p>"; /*ogranicava, limitira broj reci tj karaktera!!! prikazuje tekst (od kog texta, od 0-tog karaktera, narednih 150 karaktera)*/
					echo "<span >".$red['datum']." - ".$red['autor']."</span><br>";
                    echo "<span style='color:dodgerblue;font-size:0.7em;'>".$red['naziv']."</span><br>";
					if(isset($_SESSION['ime']) and $_SESSION['status']=="Administrator")
					{
						echo "<a class='linkclass' href='brisanje.php?id=".$red['id']."'>Obrisi vest</a> | ";
						echo "<a  class='linkclass' href='izmenivest.php?id=".$red['id']."'>Izmeni vest</a>";
					}
					if(isset($_SESSION['ime']) and $_SESSION['status']!="Administrator" and $red['autor']==$_SESSION['ime'])
					{
						echo "<a class='linkclass' href='izmenivest.php?id=".$red['id']."'>Izmeni vest</a>";
					}
					echo "<hr>";
					echo "</div>";
				}
			}
			?>
		</div>
	</div> <!--end #main-->

    <aside id="sidebar" class="cl">
		<?php
		if(isset($_SESSION['ime'])) /*ako si loginovan setovana je sesija i onda vidis "dodajvest" i "izmenivest" linkove u sidebaru!*/
		{
			$dodajvest='<div class="block">';
			$dodajvest.='<h2><a href="novavest.php">Dodaj vest</a></h2>';
			$dodajvest.='<h2><a href="izmenivest.php">izmeni vest</a></h2>';
			$dodajvest.='</div>';
			echo $dodajvest;
		}
		?>
	</aside> <!--end #sidebar-->
	<footer id="footer">
		<p>Copyright &copy; Lineweb</p>
	</footer> <!--end #footer-->

</div> <!-- end of wrapper -->
</body>
</html>
<?php mysqli_close($db); ?>
<script src="news.js"></script>
