<?php
require_once("../funkcije.php");
session_start();
if(!isset($_SESSION['ime']) or $_SESSION['status']!="Administrator")
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
        <?php
        $db=konekcija();
        if(isset($_GET['obrisana']))
        {
            $sql="UPDATE lineweb SET obrisan=0 WHERE id=".$_GET['obrisana'];
            mysqli_query($db,$sql);
            echo "Uspesno vracena prethodno obrisana vest!<br>";
            echo "<a href='obrisanevesti.php'>Povratak na obrisane vesti!</a>";
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