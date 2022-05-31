<?php
require_once("../funkcije.php");
session_start();
if(!isset($_SESSION['ime']))
{
    header('Location:login.php');
    exit();
}
?>
<!doctype html>
<html>
<!--head-->
<?php include_once "inc/head.admin.php"; ?>
<!--end head-->

<body>
<div id="wrapper">
	<header id="header" class="cl">
		<?php include('../inc/nav.admin.php') ?>
	</header> <!--end #header-->

	<div id="main" class="cl">
        <?php include_once('../inc/login.admin.nav.php') ?>

        <form action="#" method="post">
            <input type="text" id="nazivGalerije" name="nazivGalerije" placeholder="Unesite naziv galerije"><br>
            <input type="submit" value="Snimi galeriju pod nazivom:"><br>
            <br><br>
        </form>
        <?php
            if(isset($_POST['nazivGalerije']))
            {
                $nazivGalerije=$_POST['nazivGalerije'];
                if($nazivGalerije!="")
                {
                    $db=konekcija();
                    /*ovde pitam da li postoji galerija pod nazivom koji sam upisao i ako postoji vracam odgovor*/
                    $sql="SELECT * FROM galerije where nazivGalerije LIKE '%$nazivGalerije%'";
                    $odgovor=mysqli_query($db,$sql);
                    if(mysqli_num_rows($odgovor)==1)
                    {
                        echo "<b>Vec postoji galerija pod nazivom <span style='color:red;'>\"".$nazivGalerije."\"</span> !!!</b><br>";
                    }
                    else
                    {
                        $sql="INSERT INTO galerije (nazivGalerije, autor) VALUES ('$nazivGalerije', '".$_SESSION['korime']."')";
                        mysqli_query($db, $sql);
                        if(mysqli_error($db)) /*upit dal je doslo do greske prilikom upisivanja u bazu podataka...*/
                            echo "Neuspeli upit!!!".mysqli_error($db);
                        else echo 'Uspesno dodata galerija <b>"'.$nazivGalerije.'"</b>';
                    }
                }
                else echo "<b style='color:red;'>Niste uneli ime galerije!!!</b>";
            }
        ?>
        <hr>
        <!--forma za ubacivanje slika-->
        <form action="#" method="post" enctype="multipart/form-data">
            <select id="idGalerije" name="idGalerije">
                <?php
                $db=konekcija();
                $sql="SELECT id, nazivGalerije FROM galerije ORDER BY id DESC";
                $result=mysqli_query($db,$sql);
                while ($red=mysqli_fetch_object($result))
                    echo "<option value='$red->id'>$red->nazivGalerije</option>"
                ?>
            </select><br><br>
            <input type="file" id="slika1" name="slika1"><br>
            <input type="text" id="komentar1" name="komentar1" placeholder="Unesite komentar"><br><br>
            <input type="file" id="slika2" name="slika2"><br>
            <input type="text" id="komentar2" name="komentar2" placeholder="Unesite komentar"><br><br>
            <input type="submit" value="Dodaj slike">
        </form> <!--end forma za ubacivanje slika-->
        <?php
            if(isset($_FILES['slika1']['name']))
            {
                $idGalerije=$_POST['idGalerije'];
                $komentar1=$_POST['komentar1'];
                $komentar2=$_POST['komentar2'];
                $slika1=$_FILES['slika1']['name'];
                $slika2=$_FILES['slika2']['name'];
                if($slika1!="")
                {
                    $novoime=$_SESSION['korime']."_".date("Y.m.d-G.i.s",time())."_1.".pathinfo($_FILES['slika1']['name'], PATHINFO_EXTENSION); /*seassion od korime pa datum kakav hocu pa pathinfo dodaje extenziju .jpg .png ili koja je vec extenzija toga sto uploadujemo! _1 sluzi kada se uploaduju vise fajlova posto je to u isto vreme da imaju sufix _1, _2 itd... inace bi poslednji prebrisao sve ostale....*/
                    if(@move_uploaded_file($_FILES['slika1']['tmp_name'], "../imagesGallery/".$novoime)) /*ako uspe upload upise u bazu*/
                    {
                        /*mogao bi ovde da kazem if(move_uploaded_file==0) ako nije prebacio fajlove echo nije uspeo prenos a ako jeste tek onda da upisem podatke u bazu...*/
                        $sql="INSERT INTO galerijeslike (idGalerije, slika, komentar) VALUES ($idGalerije, '$novoime', '$komentar1');";
                        mysqli_query($db, $sql);
                    }
                    else /*ako ne uspe prenos (folder je drugacijeg imena itd) obavesti ovo i izbaci error*/
                    {
                        echo "Nije uspeo prenos datoteke!";
                        exit();
                    }
                }
                if($slika2!="")
                {
                    $novoime=$_SESSION['korime']."_".date("Y.m.d-G.i.s",time())."_2.".pathinfo($_FILES['slika2']['name'], PATHINFO_EXTENSION); /*seassion od korime pa datum kakav hocu pa pathinfo dodaje extenziju .jpg .png ili koja je vec extenzija toga sto uploadujemo! _1 sluzi kada se uploaduju vise fajlova posto je to u isto vreme da imaju sufix _1, _2 itd... inace bi poslednji prebrisao sve ostale....*/
                    if(@move_uploaded_file($_FILES['slika2']['tmp_name'], "../imagesGallery/".$novoime)) /*ako uspe upload upise u bazu*/
                    {
                        /*mogao bi ovde da kazem if(move_uploaded_file==0) ako nije prebacio fajlove echo nije uspeo prenos a ako jeste tek onda da upisem podatke u bazu...*/
                        $sql="INSERT INTO galerijeslike (idGalerije, slika, komentar) VALUES ($idGalerije, '$novoime', '$komentar2');";
                        mysqli_query($db, $sql);
                    }
                    else /*ako ne uspe prenos (folder je drugacijeg imena itd) obavesti ovo i izbaci error*/
                    {
                        echo "Nije uspeo prenos datoteke!";
                        exit();
                    }
                }
            }
        ?>
	</div>

	<footer id="footer">
		<p>Copyright &copy; Lineweb</p>
	</footer> <!--end #footer-->

</div> <!-- end of wrapper -->
</body>
</html>
<?php
    mysqli_close($db); /*ovde zatvaram konekciju sa bazom*/
?>
