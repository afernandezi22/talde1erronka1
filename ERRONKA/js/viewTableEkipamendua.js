var dataEkipamendua = [];
const tableLines = 10;
var actualPag = 1;

//PAGINAR LA TABLA EKIPAMENDUA
function paginarEkipamendua(direccion) {
    let totalPages = Math.ceil(dataEkipamendua.length / tableLines);

    actualPag += direccion;
    if (actualPag < 1) {
        actualPag = 1;
    }
    if (actualPag > totalPages) {
        actualPag = totalPages;
    }

    viewTableEkipamendua(dataEkipamendua, actualPag);

    document.getElementById("page-number").innerHTML = actualPag;
    document.getElementById("total-pages").innerHTML = totalPages;
}


function getDataFromURL(url) {
    //var url = "http://localhost/erronka1/controller/ekipamenduacontroller.php";
    var options = {method: "GET", mode: 'cors'};
    fetch(url, options)
        .then(response => {
            return response.json();
        })
        .then(data => {
            dataEkipamendua = data;
            //console.log("data: " + data + "dataEkipamendua: " + dataEkipamendua);
            viewTableEkipamendua(dataEkipamendua, actualPag);
        })
        .catch(err => {
            console.error("ERROR: " + err.message);
        })
}

function viewTableEkipamendua(dataEkipamendua, actualPag) {
    var tableHtmlEkipamendua = "";
    var start = (actualPag - 1) * tableLines;
    var end = start + tableLines;
    //var dataEkipamendua = dataEkipamendua.slice(start, end);

    for (var i = 0; i < dataEkipamendua.length; i++) {
        tableHtmlEkipamendua += "<tr><td><input type='checkbox'></td>"
        tableHtmlEkipamendua += "<td>" + dataEkipamendua[i]["id"] + "</td>";
        tableHtmlEkipamendua += "<td>" + dataEkipamendua[i]["izena"] + "</td>";
        tableHtmlEkipamendua += "<td>" + dataEkipamendua[i]["deskribapena"] + "</td>";
        tableHtmlEkipamendua += "<td>" + dataEkipamendua[i]["marka"] + "</td>";
        tableHtmlEkipamendua += "<td>" + dataEkipamendua[i]["modelo"] + "</td>";
        tableHtmlEkipamendua += "<td>" + dataEkipamendua[i]["stock"] + "</td></tr>";
    }
    document.getElementById("showDataEkipamendua").innerHTML = tableHtmlEkipamendua;
    console.log(tableHtmlEkipamendua);
}



//LLAMAR A LAS FUNCIONES AL CARGAR LA PAGINA
window.addEventListener("load", function(){
    paginarEkipamendua(1);
    getDataFromURL("http://localhost/erronka1/controller/ekipamenduacontroller.php")
})