<?php
function konekcija()
{
	$db=mysqli_connect("localhost", "root", "", "g1_lineweb");
	if(!$db) echo "Neuspesno povezivanje na bazu!!!";
	mysqli_query($db, "SET NAMES UTF8"); // setuje konekciju u utf8 i onda sve sa tom konekcijom komunicira utf8-micom
	return $db;
}
function prikaziMeniKategorija($db)
{
//	$sql="SELECT DISTINCT kategorija FROM lineweb";
	$sql="SELECT kategorije.* FROM lineweb RIGHT JOIN kategorije ON lineweb.id_kategorije=kategorije.id GROUP by kategorije.id";
//	$sql="SELECT kategorije.* FROM lineweb RIGHT JOIN kategorije ON lineweb.id_kategorije=kategorije.id GROUP by kategorije.id ORDER by rand()";
	$result=mysqli_query($db, $sql);
	while($red=mysqli_fetch_assoc($result))
	{
		echo "<a href='news.php?kategorija=".$red['id']."'>".$red['naziv']."</a>"; /*salje getom kategorije.id a vidljiv je kategorije.naziv*/
	}
}
function provera($a)
{
    if(strpos("$a"," ")>-1 or /*moze i ovako da se napise bez is_numeric*/
        is_numeric(strpos("$a"," "))==true or
        is_numeric(strpos("$a","#"))==true or
        is_numeric(strpos("$a","@"))==true or
        is_numeric(strpos("$a","*"))==true or
        is_numeric(strpos("$a","+"))==true or
        is_numeric(strpos("$a","-"))==true or
        is_numeric(strpos("$a","/"))==true or
        is_numeric(strpos("$a","'"))==true or
        is_numeric(strpos("$a",'"'))==true or
        is_numeric(strpos("$a",'{'))==true or
        is_numeric(strpos("$a",'}'))==true or
        is_numeric(strpos("$a",'['))==true or
        is_numeric(strpos("$a",']'))==true or
        is_numeric(strpos("$a","%"))==true or
        is_numeric(strpos("$a","&"))==true
    ){
        return false;
    }
    else return true;
}