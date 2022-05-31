<?php
require_once("funkcije.php");
session_start(); //prvo startovanje sesije pa provera da li je setovano nesto od sesija, pa ako nije redirekt odatle....
?>
    <!doctype html>
    <html>

    <!--head-->
    <?php include "inc/head.php"?>
    <!--end head-->

    <body>
    <div id="wrapper">
        <header id="header" class="cl">
            <?php include('inc/nav.php') ?>
        </header> <!--end #header-->

        <div id="main" class="cl">
            <?php
            $db = konekcija();
            //            $sql="SELECT * FROM galerije where id>0 ORDER BY id DESC";
            /*upit koji daje imena galerija samo ako sadrze u sebi slike i poredjane po id-u prvljenja...*/
            $sql = "SELECT galerije.id, galerije.nazivGalerije, galerijeslike.idGalerije
                FROM galerije, galerijeslike
                WHERE galerijeslike.idGalerije=galerije.id
                GROUP BY idGalerije /*ovde grupise da se nebi ponavljala ista galerija vise puta*/
                ORDER BY galerije.id DESC";
            $result = mysqli_query($db, $sql);
            while ($red = mysqli_fetch_object($result)) {
                echo "<a href='galleryId.php?galleryId=$red->id'>$red->nazivGalerije</a><br>";
//                echo "<div class='cl' title='$red->nazivGalerije' style='float:left; '><a style='width:255px;border:2px solid red; float:left;margin:5px; padding:5px;' href='galerije.php?idGalerije=$red->id'>".substr($red->nazivGalerije,0,30)."</a></div>"; /*ovde sam skratio reci koje se pojavljuju u naslovu sa substr funkcijom kako bi divovi zauzimali manji prostor i svi bili jednaki*/
            }
            ?>
        </div>
        <?php include_once("aside.html"); ?> <!--sajdbar-->
        <footer id="footer">
            <p>Copyright &copy; Lineweb</p>
        </footer> <!--end #footer-->

    </div> <!-- end of wrapper -->
    </body>
    </html>
<?php
mysqli_close($db); /*ovde zatvaram konekciju sa bazom*/
?>