<?php
require_once("funkcije.php");
session_start();
if(!isset($_SESSION['ime']) and $_SESSION['status']!='Administrator')
{
	header("Location:news.php");
	exit();
}
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
		if(isset($_GET['id']))
		{
            $db=konekcija();
            if(!is_numeric($_GET['id']) || $_GET['id']<1)
            {
                echo "Ne postoji vest sa takvim ID-jem";
                exit();
            }
            if (mysqli_error($db))
            {
                echo "Greska ".mysqli_errno($db);
                exit();
            }
            $sql="UPDATE lineweb SET obrisan=1 WHERE id=".$_GET['id'];
            mysqli_query($db, $sql);
            echo "Uspesno obrisana vest!!!<br>";
            echo "<a href='news.php'>Povratak na NEWS!</a>";
            mysqli_close($db);
		}
		?>
	</div>
	<footer id="footer">
		<p>Copyright &copy; Lineweb</p>
	</footer> <!--end #footer-->

</div> <!-- end of wrapper -->
</body>
</html>
