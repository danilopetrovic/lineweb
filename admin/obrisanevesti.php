<?php
session_start();
if(!isset($_SESSION['ime'])/* or $_SESSION['status']!="Administrator"*/) /*ako nije admin mogu odma redirekt mada lepse da ispise nema prava pristupa*/
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

        <?php
        if(($_SESSION['status']!="Administrator"))
        {
            echo "<h2>Nemate prava pristupa ovoj stranici jer niste Administrator!</h2>";
        }
        else
        {
            $db=konekcija();
            $sql="SELECT * FROM lineweb WHERE obrisan=1";
            if(isset($_GET['id']))
                $sql="SELECT * FROM lineweb WHERE id=".$_GET['id'];
            $result=mysqli_query($db, $sql);
            while($red=mysqli_fetch_object($result))
            {
                echo '<div class="cl">';
                echo "<a href=obrisanevesti.php?id=".$red->id."><h2>".$red->naslov."</h2></a>";
                if($red->slika!="")
                {
                    echo "<a href=obrisanevesti.php?id=".$red->id."><img class='malaslikavesti cl' src='../imagesFromNews/".$red->slika."'></a>";
                }
                echo "<p>".substr($red->sadrzaj, 0, 150)."</p>";
                echo $red->datum." - ".$red->autor."<br>";
                echo "<a href='../izmenivest.php?id=".$red->id."'>Izmeni vest</a>";
                echo " | <a href='obrisanevestiVrati.php?obrisana=".$red->id."'>Vrati obrisanu vest</a>";
                echo "<hr>";
                echo '</div>';
            }
            mysqli_close($db); /*ovde zatvaram konekciju sa bazom*/
        }

        ?>
	</div>
    <footer id="footer">
		<p>Copyright &copy; Lineweb</p>
	</footer> <!--end #footer-->

</div> <!-- end of wrapper -->
</body>
</html>