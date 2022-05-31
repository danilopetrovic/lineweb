<?php
$logout = "";
$padajuci1 = "";
$padajuci2 = "";
$login = '<li><a href="login.php"><i class="fa fa-sign-in" aria-hidden="true"></i> login</a></li>';
if (isset($_SESSION['ime'])) {
    $padajuci1 = '<ul>
                    <li><a href="../novavest.php">add news</a></li>
                    <li><a href="../izmenivest.php">edit news</a></li>
                </ul>';
    $padajuci2 = '<ul>
                    <a href="addgallery.php">add gallery</a>
                </ul>';
    $login = '<li><a href="login.php"><i class="fa fa-user" aria-hidden="true"></i> ' . $_SESSION['ime'] . ' <span style="font-size: 0.6em;vertical-align:bottom">(' . $_SESSION["status"] . ')</span></a></li>';
    $logout = '<li><a id="logout" href="login.php?logout" onclick="potvrdiAdmin();"><i class="fa fa-sign-out" aria-hidden="true"></i> logout</a></li>';
    $logout .= '';
}
?>
<a href="../index.php">
    <div id="logo">
        <img src="../images/logo.png" alt="logo.png">
    </div>
</a>

<nav id="nav">
    <ul>
        <li><a href="../news.php?limit=0"><i class="fa fa-home" aria-hidden="true"></i> news</a>
            <?= $padajuci1 ?>
        </li>
        <li><a href="../gallery.php"><i class="fa fa-picture-o" aria-hidden="true"></i> gallery</a>
            <?= $padajuci2 ?>
        </li>
        <?= $login ?>
        <?= $logout ?>
    </ul>
</nav>
<script type="text/javascript">
    function potvrdiAdmin()
    {
        var link;
        var r = confirm("Potvrdi logout!!!");
        if (r == true)
            link = "login.php?logout";
        else
            link = "";
        document.getElementById("logout").setAttribute("href",link);
    }
</script>
