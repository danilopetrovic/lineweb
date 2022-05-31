<?php
session_start();
if (!isset($_SESSION['ime'])) {
    header('Location:login.php');
    exit();
}
require_once("../funkcije.php");
$db = konekcija();
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
            <?php
            echo "stranica u izradi..."
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