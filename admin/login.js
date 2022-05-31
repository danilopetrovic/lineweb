/**
 * Created by Danilo on 11-Apr-17.
 */
/*ova funkcija menja boju*/
function promeniBojuPolja(a)
{
    if(a.value.length>=6 && a.value.length<=25)
    {
        if(!proveri(a.value))
            a.style.backgroundColor="red";
        else
            a.style.backgroundColor="green";
    }
    if(a.value.length<6 || a.value.length>25)
        a.style.backgroundColor="white";
}

/*ova funkcija proverava sve kad se submituje*/
function proveriLogin() /*ovde proveravam nedozvoljene karaktere kroz funkciju proveri koju pozivam za svako polje*/
{
    var korime=document.getElementById("korime"); /*uzimam kompletan objekat umesto samo value*/
    var lozinka=document.getElementById("lozinka");
    if(!proveri(korime.value))
    {
        alert("Korisnicko ime sadrzi nedozvoljeni karakter!!!");
        korime.focus();
        return false;
    }
    if(!proveri(lozinka.value))
    {
        alert("Lozinka sadrzi nedozvoljeni karakter!!!");
        lozinka.focus();
        return false;
    }
    if(korime.value.length==0)
    {
        alert("Popunite sva polja!");
        korime.focus();
        korime.style.backgroundColor="yellow";
        return false;
    }
    if(lozinka.value.length==0)
    {
        alert("Popunite sva polja!");
        lozinka.focus();
        lozinka.style.backgroundColor="yellow";
        return false;
    }
    if(korime.value.length<6 || korime.value.length>25 || lozinka.value.length<6 || lozinka.value.length>25)
    {
        alert("Korisnicko ime i lozinka moraju sadrzati najmanje 6 a najvise 25 karaktera!");
        return false;
    }
}

function proveri(promenljiva)
{
    if( promenljiva.indexOf(" ")>-1 ||
        promenljiva.indexOf("=")>-1 ||
        promenljiva.indexOf("#")>-1 ||
        promenljiva.indexOf("@")>-1 ||
        promenljiva.indexOf("*")>-1 ||
        promenljiva.indexOf("+")>-1 ||
        promenljiva.indexOf("-")>-1 ||
        promenljiva.indexOf("/")>-1 ||
        promenljiva.indexOf("%")>-1 ||
        promenljiva.indexOf("&")>-1)
    {
        return false;
    }
    return true;
}