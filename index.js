// function adjustSize (base64logo){
//     var img = new Image();
//     img.src = 'data:image/png; base64,'+ base64logo +'';
//     var newW = img.naturalWidth / 2;
//     var newH = img.naturalHeight /2;
//     var newImg = new Image();
//     newImg.src = 'data:image/png; base64,'+ base64logo +'';
//     newImg.width = newW;
//     newImg.height = newH;
//     return newImg;
// }
function addRow (data){
    console.log(data);
    var tbody = document.getElementById("corpotab");
    var tr = document.createElement("tr");
    // var logo = document.createElement("td");
    // var img = new Image();
    // img.src = 'data:image/png; base64,'+ data.logo +'';
    // logo.appendChild(img);
    var entityid = document.createElement("td");
    var etext = document.createTextNode(data.entity_id);
    entityid.appendChild(etext);
    // var federation = document.createElement("td");
    // var ftext = document.createTextNode(data.reg_auth);
    // federation.appendChild(ftext);
    var name = document.createElement("td");
    var nametext = document.createTextNode(data.name);
    name.appendChild(nametext);
    // var pp = document.createElement("td");
    // var pptext = document.createTextNode(data.pp);
    // pp.appendChild(pptext);
    var org_name = document.createElement("td");
    var orgntext = document.createTextNode(data.org[0]);
    org_name.appendChild(orgntext);
    var org_url = document.createElement("td");
    var orgutext = document.createTextNode(data.org[1]);
    org_url.appendChild(orgutext);
    // var l_link = document.createElement("td");
    // var logintext = document.createTextNode(data.login_link);
    // l_link.appendChild(logintext);
    // tr.appendChild(logo);
    tr.appendChild(entityid);
    // tr.appendChild(federation);
    tr.appendChild(name);
    // tr.appendChild(pp);
    tr.appendChild(org_name);
    tr.appendChild(org_url);
    // tr.appendChild(l_link);
    tbody.appendChild(tr);
}

$(document).ready(function() {
    //Eseguo una richiesta all'API per popolare la pagina html
    $.ajax({
        url: "SP.php",
        type: 'GET',
        dataType: 'json',
        contentType: "application/json; charset=utf-8",
        success: function(data) {
            for (var i = 0; i < data.length; i++){
                addRow(data[i]);
            }
        },
        error: function() {
            console.log('error');
        },

    });
})