<script src="dodajkorisnika.js"></script>
<?php
session_start();
if (!isset($_SESSION['ime'])) {
    header('Location:login.php');
    exit();
}
include_once('../funkcije.php');
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
        if (($_SESSION['status'] != "Administrator")) {
            echo "<h2>Nemate prava pristupa ovoj stranici jer niste Administrator!</h2>";
        } else
            echo '<h3>Kreiranje novog korisnika:</h3>
            <form action="#" method="post" name="kreiranjeKorisnika" onsubmit="return provera();">
                <input type="text" name="username" id="username" placeholder="Unesite korisnicko ime" required><br>
                <input type="text" name="pass" id="pass" placeholder="Unesite lozinku" required><br>
                <input type="text" name="pass2" id="pass2" placeholder="Ponovite lozinku" required><br>
                <input type="text" name="ime" id="ime" placeholder="Unesite svoje ime" required><br>
                <input type="text" name="prezime" id="prezime" placeholder="Unesite svoje prezime" required><br>
                Status: <select name="status" id="status" required>
                    <option value="Korisnik" selected>Korisnik</option>
                    <option value="Urednik">Urednik</option>
                    <option value="Administrator">Administrator</option>
                </select><br>
                <input type="submit" value="NapraviKorisnika"> <!--ovde value="NapraviKorisnika" mora da bude bez razmaka zato sto dodajkorisnika.js proverava i to input sa getElementsByTagName polje pa nadje gresku kroz petlju-->
            </form>';

        if (isset($_POST['username']) and isset($_POST['pass']) and isset($_POST['pass2']) and isset($_POST['status']) and isset($_POST['status']) and isset($_POST['ime']) and isset($_POST['prezime'])) {
            $username = $_POST['username'];
            $pass = $_POST['pass'];
            $pass2 = $_POST['pass2'];
            $status = $_POST['status'];
            $ime = $_POST['ime'];
            $prezime = $_POST['prezime'];
            if (strlen($username) < 6 or strlen($username) > 20) {
                echo "Korisnicko ime sadrzi manje od 6 ili vise od 20 karaktera";
                exit();
            }
            if (strlen($pass) < 6 or strlen($pass) > 20 or strlen($pass2) < 6 or strlen($pass2) > 20) {
                echo "Lozinka sadrzi manje od 6 ili vise od 20 karaktera";
                exit();
            }
            if (strlen($ime) > 25 or strlen($prezime) > 25) {
                echo "Ime ili Prezime sadrze vise od 25 karaktera";
                exit();
            }
            if ($pass != $pass2) {
                echo "Lozinka i ponovljena lozinka nisu jednake";
                exit();
            }
            if (provera($username) == false) {
                echo "Korisnicko ime ima nedozvoljeni karakter";
                exit();
            }
            if (provera($pass) == false or provera($pass2) == false) {
                echo "Lozinka ili ponovljena lozinka imaju nedozvoljen karakter";
                exit();
            }
            if (provera($ime) == false) {
                echo "Ime sadrzi nedozvoljeni karakter";
                exit();
            }
            if (provera($prezime) == false) {
                echo "Prezime sadrzi nedozvoljeni karakter";
                exit();
            }
            $db = konekcija();
            $crypt = hash('sha256', $pass . $username, false); /*slepio sam pass i username pa onda heshovao i ubacio u bazu*/
            $sql = "INSERT INTO korisnici (korime, lozinka, ime, status) VALUES ('$username','$crypt','$ime $prezime','$status')";
            $odgovor = mysqli_query($db, $sql);
            if (mysqli_errno($db)) {
                echo "Korisnicko ime vec postoji u bazi... Probajte ponovo sa razlicitim korisnickim imenom!!!";
            } //            print_r($db);
            else
                echo "Uspesno dodat korisnik";

        }
        ?>

    </div>
    <footer id="footer">
        <p>Copyright &copy; Lineweb</p>
    </footer> <!--end #footer-->

</div> <!-- end of wrapper -->
</body>
</html>