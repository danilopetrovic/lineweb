<?php
require_once("funkcije.php");
session_start(); //prvo startovanje sesije pa provera da li je setovano nesto od sesija, pa ako nije redirekt odatle....
if (!isset($_SESSION['ime'])) {
    header('Location:login.php');
    exit();
}
?>
    <!doctype html>
    <html>

    <!--head-->
    <?php include "inc/head.php" ?>
    <!--end head-->

    <body>
    <div id="wrapper">
        <header id="header" class="cl">
            <?php include('inc/nav.php') ?>
        </header> <!--end #header-->

        <div id="main" class="cl">
            //////////////////////////////////////////////////////////////////////////////////////
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