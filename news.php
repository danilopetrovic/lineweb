<?php
OB_START();
require_once("funkcije.php");
session_start();
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lineweb2</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i&amp;subset=latin-ext" rel="stylesheet">
    <script src="admin/jquery-3.2.1.js"></script>
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <?php include_once "inc/favicon.html" ?>
</head>
<style>
    /*paging linkovi izgled*/
    #newsLinkovi{
        text-align:center;
        font-size: 0.85em;
    }
    /*obrisi vest i izmeni vest linkovi*/
    .vestLinkovi {
        font-size: 0.8em;
    }
</style>
<body>
<div id="wrapper">
    <header id="header" class="cl">
        <?php include('inc/nav.php') ?>
    </header> <!--end #header-->
    <div id="main" class="cl">
        <div id="kategorije">
            <a href="news.php?limit=0">Sve vesti</a>
            <?php /*ovde izlistava sve kategorije vesti iz funkcije!!!*/
            $db=konekcija();
            prikaziMeniKategorija($db);
            ?>
            <div id="divpretraga">
                <form action="#" method="get">
                    <input type="text" id="pretraga" name="pretraga" placeholder="pretraga po sadrzaju ili naslovu" style="width:200px;">
                    <input type="submit" value="pretraži">
                </form>
            </div>
        </div>
        <div id="sadrzaj">
            <?php
            $sql="SELECT lineweb.*,kategorije.naziv FROM lineweb JOIN kategorije ON lineweb.id_kategorije=kategorije.id WHERE obrisan=0 ORDER BY datum DESC"; /*sve vesti*/
            $poStrani = 5;
            $ukupnoVesti = mysqli_num_rows(mysqli_query($db, "SELECT * FROM lineweb"));
            if(isset($_GET['kategorija']))
                $ukupnoVesti = mysqli_num_rows(mysqli_query($db, "SELECT lineweb.*,kategorije.* FROM lineweb JOIN kategorije ON lineweb.id_kategorije=kategorije.id where kategorije.id='".$_GET['kategorija']."'"));
            $brojLinkova=floor($ukupnoVesti/$poStrani);
//            print_r($brojLinkova);
            if(isset($_GET['limit']))
            {
                $limit=$_GET['limit'];
                $sql="SELECT lineweb.*,kategorije.naziv FROM lineweb JOIN kategorije ON lineweb.id_kategorije=kategorije.id WHERE obrisan=0 ORDER BY datum DESC LIMIT $limit, $poStrani";
            }
            else
                $limit=0;
            if(isset($_GET['kategorija']))
                $sql="SELECT lineweb.*, kategorije.naziv FROM lineweb JOIN kategorije ON lineweb.id_kategorije=kategorije.id WHERE obrisan=0 AND id_kategorije='".$_GET['kategorija']."' ORDER BY datum DESC LIMIT $limit, $poStrani";
            if(isset($_GET['id']))
                $sql="SELECT lineweb.*,kategorije.naziv FROM lineweb JOIN kategorije ON lineweb.id_kategorije=kategorije.id WHERE lineweb.id=".$_GET['id'];
            /*pocetak pretrage koda*/
            if(isset($_GET['pretraga']))
            {
                if(provera($_GET['pretraga'])==false)
                {
                    echo "koristili ste neki od nedozvoljenih karaktera u pretrazi (*, +, -, =, ', \", {, }, [, ], ......)";
                    exit();
                }
                else
                {
                    $pretraga=$_GET['pretraga'];
                    $sql="SELECT lineweb.*,kategorije.naziv FROM lineweb JOIN kategorije ON lineweb.id_kategorije=kategorije.id WHERE naslov like '%$pretraga%' or sadrzaj like '%$pretraga%'";
                    $ukupnoVesti = mysqli_num_rows(mysqli_query($db, $sql));
                }
            }/*kraj pretrage*/
            $result = mysqli_query($db, $sql);
            if(isset($_GET['pretraga']) && provera($_GET['pretraga'])==true) /*ako je setovana pretraga onda da kaze koliko ima rezultata u tom upitu*/
                echo "Broj rezultata pretrage je: ".$ukupnoVesti;
            while($red=mysqli_fetch_assoc($result))
            {
                // OVO SU VISE VESTI
                if(!isset($_GET['id'])) // ako nije setovan id onda prikazuje sve vesti
                {
                    echo '<div class="cl">'; /*ceo sadrzaj je u okviru diva koji ima clear klasu definisanu u css-u zbog floatovane slike desno (da nebi sadrzaj iz donje vesti upadao u gornju)*/
                    echo "<a href=vest.php?id=".$red['id']."><h2>".$red['naslov']."</h2></a>"; /*naslov u obliku linka koji je linkovan sa id-om*/
                    if($red['slika']!="")
                    {
                        /*i slika je link ka vesti*/
                        echo "<a href=vest.php?id=".$red['id']."><img class='malaslikavesti cl' src='imagesFromNews/".$red['slika']."'></a>";
                    }
                    echo "<p>".substr($red['sadrzaj'], 0, 150)."</p>"; /*ogranicava, limitira broj reci tj karaktera!!! prikazuje tekst (od kog texta, od 0-tog karaktera, narednih 150 karaktera)*/
                    echo "<span style='font-size: 0.7em;'><i class='fa fa-calendar' aria-hidden='true'  style='opacity: 0.5;'></i> ".date('Y M d - G:i:s', strtotime($red['datum']))." - <i class='fa fa-user-circle-o' aria-hidden='true'  style='opacity: 0.5;'></i> ".$red['autor']."</span><br>";
                    echo "<span style='color:dodgerblue;font-size:0.7em;'>".$red['naziv']."</span><br>";
                    if(isset($_SESSION['ime']) and $_SESSION['status']=="Administrator")
                    {
                        echo "<a class='vestLinkovi' class='linkclass' href='brisanje.php?id=".$red['id']."'><i class='fa fa-trash-o' aria-hidden='true'></i> Obrisi vest</span></a> | ";
                        echo "<a class='vestLinkovi' href='izmenivest.php?id=".$red['id']."'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Izmeni vest</a>";
                    }
                    if(isset($_SESSION['ime']) and $_SESSION['status']!="Administrator" and $red['autor']==$_SESSION['ime'])
                    {
                        echo "<a class='linkclass' href='izmenivest.php?id=".$red['id']."'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Izmeni vest</a>";
                    }
                    echo "<hr>";
                    echo "</div>";
                }
            }
            ?>
            <div id="newsLinkovi">
                <span>Trenutra strana: <?php echo $limit/$poStrani+1 . "|"; ?>
                <?php
                for($i=0;$i<$brojLinkova;$i++)
                {
//                    if($i<5) /*nije dobro resenje jer stampa samo prvih 5*/
                        echo "<a href='news.php?limit=".($i*$poStrani)."'>".($i+1)."</a> ";
                }
                echo " | <a href='news.php?limit=0'>Prva strana</a>";
                if($limit>0 && ($limit-$poStrani)>=0)
                    echo " | <a href='news.php?limit=".($limit-$poStrani)."'>Prethodna 《《</a>";
                if($limit<($i*$poStrani)-$poStrani)
                    echo " | <a href='news.php?limit=".($limit+$poStrani)."'>》》 Sledeca</a>";
                echo " | <a href='news.php?limit=".(($i*$poStrani)-$poStrani)."'>Poslednja strana</a>";
                ?>
                </span>
                <br>
                <form method="post" action="#">
                    Izaberite stranu:
                    <input type="text" id="izaberistranu" name="izaberistranu"/>
                    <input type="submit" value="izaberi"/>
                </form>
                <?php
                if (isset($_POST['izaberistranu'])) {
                    $izaberistranu = $_POST['izaberistranu'];
                    header('Location:news.php?limit='.(($izaberistranu-1)*$poStrani));
                }
                ?>
<!--                <form method="post" action="#">-->
<!--                    Po strani:-->
<!--                    <select id="postrani" name="postrani">-->
<!--                        <option value="2">2</option>-->
<!--                        <option value="5">5</option>-->
<!--                        <option value="10">10</option>-->
<!--                    </select>-->
<!--                </form>-->
            </div>
        </div><!--end #sadrzaj-->
    </div> <!--end #main-->

    <aside id="sidebar" class="cl">
        <?php
        if(isset($_SESSION['ime'])) /*ako si loginovan setovana je sesija i onda vidis "dodajvest" i "izmenivest" linkove u sidebaru!*/
        {
            $dodajvest='<div class="block">';
            $dodajvest.='<h2><a href="novavest.php">Dodaj vest</a></h2>';
            $dodajvest.='<h2><a href="izmenivest.php">izmeni vest</a></h2>';
            $dodajvest.='</div>';
            echo $dodajvest;
        }
        ?>
    </aside> <!--end #sidebar-->
    <footer id="footer">
        <p>Copyright &copy; Lineweb</p>
    </footer> <!--end #footer-->

</div> <!-- end of wrapper -->
</body>
</html>
<?php mysqli_close($db); ?>
<script src="news.js"></script>