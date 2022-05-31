<?php
session_start(); //prvo startovanje sesije pa provera da li je setovano nesto od sesija, pa ako nije redirekt odatle....
if(isset($_SESSION['ime'])) // ako si vec ulogovan pita da li postoji sesija i ako postoji ne salje te opet na login (jer si vec ulogovan) nego te preusmerava na podesavanja!
{
    header ("Location:podesavanja.php");
}
require_once("../funkcije.php");
require_once("class_Log.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Lineweb2</title>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i&amp;subset=latin-ext" rel="stylesheet">
<meta name="viewport" content="width=device-width">
<link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<?php include_once "../inc/admin.favicon.html" ?> ZBOG OVOGA NE RADI SESSION START I HEADER
</head>

<body>
<div id="wrapper">
	<header id="header" class="cl">
		<?php include('../inc/nav.admin.php') ?>
	</header> <!--end #header-->
	
	<div id="main" class="cl">
		<form action="#" method="post" onsubmit="return proveriLogin();">
		<input type="text" id="korime" name="korime" placeholder="Korisnicko ime" oninput="promeniBojuPolja(this);"><br>
		<input type="text" id="lozinka" name="lozinka" placeholder="Lozinka" oninput="promeniBojuPolja(this);"><br>
		<input type="submit" value="Prijavite se">
		</form>
		
		<?php
		if(isset($_GET['logout']))
		{
			session_start();
			unset($_SESSION['ime']);
			unset($_SESSION['status']);
			unset($_SESSION['korime']);
			session_destroy();
		}

		if(isset($_POST['korime']) and isset($_POST['lozinka']))
		{
			if(empty($_POST['korime']) or empty($_POST['lozinka']))
			{
                echo "Niste popunjena oba polja!";
                exit();
			}
            if(provera($_POST['korime'])==false)
            {
                echo "PHP provera - koristili ste nedozvoljene karaktere!!!";
                exit();
            }
            $db=konekcija();
			$korime=$_POST['korime'];
			$lozinka=$_POST['lozinka'];
			$korime=mysqli_real_escape_string($db,$korime); /*priprema polja! odbrana od sqli injection!*/
            $lozinka=mysqli_real_escape_string($db,$lozinka);
            $crypt= hash ('sha256', $lozinka.$korime, false); /*uzima slepljenu lozinku i korime kao proveru za hash*/
//            echo substr('ovojenekistring', -5, 3); /*od pozadi -4 karaktera pa procitaj 3 rezultat bi bio "tri"*/
            $sql="SELECT * FROM korisnici WHERE korime='$korime' AND lozinka='$crypt'";
			$result=mysqli_query($db,$sql);
			if(mysqli_num_rows($result)==0)
			{
				echo "Nisu ispravni podaci!";
				$obj=new Log("Neuspesna prijava sa korime: $korime i lozinka: $lozinka"); //upisivanje u log fajl, za uspesan login koristim sesiju a za neuspesan podatke koje mi prosledi korisnik formom...
				$obj->upisLogovanje();
				exit();
			}
			else
			{
                session_start();
				$red=mysqli_fetch_object($result);
                $_SESSION['ime']=$red->ime;
                $_SESSION['korime']=$red->korime; // korime koristim da bih imena slika imenovao sa korime i datumom
                $_SESSION['status']=$red->status;
                header('Location:podesavanja.php');
				$obj=new Log("Uspesna prijava korisnika: ".$red->korime);
				$obj->upisLogovanje();
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
<script type="text/javascript" src="login.js"></script>
