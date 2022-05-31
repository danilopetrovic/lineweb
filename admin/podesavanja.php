<?php
session_start();
if(!isset($_SESSION['ime']))
{
	header('Location:login.php');
	exit();
}
?>
<script src="jquery-3.2.1.js"></script>
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
		<h1>Podesavanja</h1>
		<h3>Dobrodosli "<?=$_SESSION['ime']?>"</h3>
        <p>Prijavili ste se kao <b style='color:red'>"<?=$_SESSION['status']?>"</b></p>
	</div>
	<footer id="footer">
		<p>Copyright &copy; Lineweb</p>
	</footer> <!--end #footer-->

</div> <!-- end of wrapper -->
</body>
</html>