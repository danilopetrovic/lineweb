<?php
require_once("funkcije.php");
session_start(); //prvo startovanje sesije pa provera da li je setovano nesto od sesija, pa ako nije redirekt odatle....
$db=konekcija();
?>
<!doctype html>
<html>
<head>

    <!--head-->
    <?php include "inc/head.php"?>
    <!--end head-->

</head>

<body>
<div id="wrapper">
	<header id="header" class="cl">
		<?php include('inc/nav.php') ?>
	</header> <!--end #header-->
	
	<div id="main" class="cl" style="text-align: center;">
        <?php
            if(isset($_GET['imgId'])) /*ovo saljem getom kada kliknem sliku da se uvelica a generisan je kada su prikazane sve slike u galeriji*/
            {
                $idSlike=intval($_GET['imgId']);
                if($idSlike>0)
                {
                    $sql="SELECT * FROM galerijeslike WHERE id=$idSlike";
                    $result=mysqli_query($db,$sql);
                    while($red=mysqli_fetch_object($result))
                    {
                        echo "<img src='imagesGallery/$red->slika' style='float:none; height:500px; max-width:600px;'><br>";
                        if($red->komentar!="")
                        {
                            echo "$red->komentar<hr>";
                        }
                        else echo "<span style='color:red;'>Ova slika nema komentar!!!</span><hr>";
                    }
                }
                else echo "Nesto nije u redu sa slikom!!!<br><br>";
            }
            if(isset($_GET['galleryId'])) /*ovde docekujem get parametar $_GET[galleryId] koji dobijam sa gallery.php stranice */
            {
                $galleryId=$_GET['galleryId'];
                $sql="SELECT * FROM galerijeslike WHERE idGalerije='$galleryId'";
                $result=mysqli_query($db,$sql);
                if(mysqli_num_rows($result)>0)
                {
                    while($red=mysqli_fetch_object($result))
                        echo "<a href='galleryId.php?galleryId=$galleryId&imgId=$red->id'><img src='imagesGallery/$red->slika' style='float:none;border:1px solid blue;margin:5px;max-width:150px; max-height:100px' alt='$red->slika'></a>";
                }
                else echo "Nema nijedna slika za izabranu galeriju!!!";
            }
        ?>
	</div>
    <?php include_once ("aside.html");?> <!--sajdbar-->

    <footer id="footer">
		<p>Copyright &copy; Lineweb</p>
	</footer> <!--end #footer-->

</div> <!-- end of wrapper -->
</body>
</html>
<?php
    mysqli_close($db); /*ovde zatvaram konekciju sa bazom*/
?>