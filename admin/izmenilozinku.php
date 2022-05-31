<?php
session_start();
if(!isset($_SESSION['ime']))
{
	header('Location:login.php');
	exit();
}
require_once("../funkcije.php");
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
		
		<br>
		<form method="post" action="#">
			<input type="text" name="staralozinka" id="staralozinka" placeholder="Unesite staru lozinku"><br>
			<input type="text" name="novalozinka1" id="staralozinka" placeholder="Unesite novu lozinku"><br>
			<input type="text" name="novalozinka2" id="staralozinka" placeholder="Ponovite novu lozinku"><br>
			<input type="submit" value="Promeni lozinku">
		</form>
		
		<?php
        echo "stranica u izradi...";
		?>
	</div>
    <footer id="footer">
		<p>Copyright &copy; Lineweb</p>
	</footer> <!--end #footer-->

</div> <!-- end of wrapper -->
</body>
</html>
