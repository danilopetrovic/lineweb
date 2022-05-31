/**
 * Created by Danilo on 17-Apr-17.
 */

/*mana ovoga je sto mi proverava i submit dugme jer je type="text" pa vrsi promenu tog dugmeta*/
function provera()
{
    var niz=document.getElementsByTagName("input");
    for(var i=0;niz.length;i++)
    {
            // alert (niz[i].value);
            if (!proveriKaraktere(niz[i].value))
            {
                alert("imate nedozvoljen karakter na polju "+(i+1));
                niz[i].style.backgroundColor="red";
                niz[i].focus();
                return false;
            }
            if (niz[i].value.length<6 || niz[i].value.length>25) /*ako neko od polja ne odgovara duzini fokusira ga i oboji u crveno*/
            {
                alert("Polje "+(i+1)+", sadrzi manje od 6 ili vise od 25 karaktera ");
                niz[i].style.backgroundColor="red";
                niz[i].focus();
                return false
            }
            if (niz[1].value!=niz[2].value) /*ako lozinke nisu iste prebrise i fokusira prvo polje*/
            {
                alert("lozinka i ponovljena lozinka nisu iste!");
                niz[1].value="";
                niz[2].value="";
                niz[1].focus();
                return false;
            }
            else {
                niz[i].style.backgroundColor="green";
            }
    }
}

function proveriKaraktere(promenljiva)
{
    if(promenljiva.type="text")
    {
        if (promenljiva.indexOf(" ")>-1 ||
            promenljiva.indexOf("=")>-1 ||
            promenljiva.indexOf("#")>-1 ||
            promenljiva.indexOf("@")>-1 ||
            promenljiva.indexOf("*")>-1 ||
            promenljiva.indexOf("+")>-1 ||
            promenljiva.indexOf("-")>-1 ||
            promenljiva.indexOf("/")>-1 ||
            promenljiva.indexOf("%")>-1 ||
            promenljiva.indexOf("'")>-1 ||
            promenljiva.indexOf('"')>-1 ||
            promenljiva.indexOf("&")>-1)
        {
            return false;
        }
        return true;
    }

}