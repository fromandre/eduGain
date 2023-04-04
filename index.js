$(document).ready(function() {
    //Eseguo una richiesta all'API per popolare la pagina html
    $.ajax({
        url: "SP.php",
        type: 'GET',
        dataType: 'json',
        contentType: "application/json; charset=utf-8",
        success: function(data) {
            document.getElementsByTagName("body").innerHTML = "";
            document.getElementsByTagName("body").innerHTML += json_decode(data, true);
            console.log("OK");
        },
        error: function() {
            console.log('error');
        },
        timeout: 60000 //Ho provato a mettere un timeout alla richiesta durante un tentativo
    });
})