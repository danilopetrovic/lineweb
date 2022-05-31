<?php
/*kriptovanje*/

$username='bbosko';
$password='bbosko';
$crypt= hash ('sha256', $password.$username, false);
echo strlen($crypt)."<br>";
echo $crypt;
echo "<hr>";


$string = "ovojenekistring";
echo substr($string, -4, 3)."<br>"; /*biram karaktere iz stringa (pocni od pozadi -4 pa prikazi 3 karaktera)*/

echo crypt($string, '$5$');
echo "<br>";
echo strlen(crypt($string, '$5$'));
echo "<br>";
/*kriptovanje*/
echo crypt($string, '$2y$10$iusesomecrazystrings2222222');
echo "<br>";
echo strlen(crypt($string, '$2y$10$iusesomecrazystrings2222222'));
echo "<hr>";
?>

<?php
/* These salts are examples only, and should not be used verbatim in your code.
   You should generate a distinct, correctly-formatted salt for each password.
*/
    echo 'Standard DES: ' . crypt($string, 'rl') . "<br>";
    echo 'Extended DES: ' . crypt($string, '_J9..rasm') . "<br>";
    echo 'MD5:          ' . crypt($string, '$1$rasmusle$') . "<br>";
    echo 'Blowfish:     ' . crypt($string, '$2y$12$usesomeafffffsdfdsafdsafassillystringforsalt$') . "<br>";
    echo 'SHA-256:      ' . crypt($string, '$5$rounds=5000$usesomesillystringforsalt$') . "<br>";
    echo 'SHA-512:      ' . crypt($string, '$6$rounds=5000$usesomesillystringforsalt$') . "<br>";
?>

