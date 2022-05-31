<?php
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
		<?php
			if(($_SESSION['status']!="Administrator"))
			{
				echo "<h2>Nemate prava pristupa ovoj stranici jer niste Administrator!</h2>";
			}
			else
			{
				echo '<h1>Posebna</h1>';
				echo "<h3>Dobrodosli \"".$_SESSION['ime']."\"</h3>";
				echo "<p>Prijavili ste se kao <b>\"".$_SESSION['status']."\"</b> Ovoj stranici mogu da pristupe samo administratori...</p>";
			}
		?>
	</div>
	<footer id="footer">
		<p>Copyright &copy; Lineweb</p>
	</footer> <!--end #footer-->

</div> <!-- end of wrapper -->
</body>
</html>
