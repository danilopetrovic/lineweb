/**
 * Created by Danilo on 29-May-17.
 */
$(document).ready(function () {
    $.get("newsAjax11111111.php", function (odgovor) {
        $("#main").html(odgovor);
    });
});