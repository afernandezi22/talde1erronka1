//FUNCIONA PARA TODAS LAS TABLAS --> CONFIMADAS: EKIPAMENDUA.PHP + EKIPAMENDUA.PHP
var dataEkipamendua = [];
var dataInbentarioa = [];
var dataAll  = [];
const tableLines = 10;
var actualPag = 1;
var totalPages = 0;

//PAGINAR LAS TABLAS
function paginar(direccion, tableId) {

    actualPag += direccion;
    if (actualPag < 1) {
        actualPag = 1;
    }
    if (actualPag > totalPages) {
        actualPag = totalPages;
    }

    viewTable(dataAll, actualPag, tableId);

    document.getElementById("page-number").innerHTML = actualPag;
    document.getElementById("total-pages").innerHTML = totalPages;
}


function getDataFromURL(tableId) {
    var options = { method: "GET", mode: 'cors' };
    var url;

    if (tableId == "ekipamenduaTable"){
        url = "http://localhost/erronka1/controller/ekipamenduacontroller.php";
    } else if (tableId == "inbentarioaTable") {
        url = "http://localhost/erronka1/controller/inbentarioacontroller.php";
    } else {
        console.error("ERROR: Invalid tabbleID");
        return;
    }



    fetch(url, options)
        .then(response => response.json())
        .then(data => {
            dataAll = data;
            console.log(dataAll);
            totalPages = Math.ceil(dataAll.length / tableLines);
            paginar(0, tableId);  // Para asegurar que se inicie en la página 1
        })
        .catch(err => {
            console.error("ERROR: " + err.message);
        })
}

function viewTable(dataAll, actualPag, tableId) {
    var tableHtml = "";
    var start = (actualPag - 1) * tableLines;
    var end = start + tableLines;

    if(tableId == "ekipamenduaTable"){
        dataEkipamendua = dataAll;
        for (var i = start; i < Math.min(end, dataEkipamendua.length); i++) {
            tableHtml += "<tr><td><input type='checkbox' id=" + dataEkipamendua[i]["id"] + "></td>"
            tableHtml += "<td>" + dataEkipamendua[i]["id"] + "</td>";
            tableHtml += "<td>" + dataEkipamendua[i]["izena"] + "</td>";
            tableHtml += "<td>" + dataEkipamendua[i]["deskribapena"] + "</td>";
            tableHtml += "<td>" + dataEkipamendua[i]["marka"] + "</td>";
            tableHtml += "<td>" + dataEkipamendua[i]["modelo"] + "</td>";
            tableHtml += "<td>" + dataEkipamendua[i]["stock"] + "</td></tr>";
        }
        document.getElementById("showDataEkipamendua").innerHTML = tableHtml;
    } else if (tableId == "inbentarioaTable") {
        dataInbentarioa = dataAll;
        for (var i = start; i < Math.min(end, dataInbentarioa.length); i++){
            tableHtml += "<tr><td><input type='checkbox'></td>";
            tableHtml += "<td>" + dataInbentarioa[i]["etiketa"] + "</td>";
            tableHtml += "<td>" + dataInbentarioa[i]["idEkipamendu"] + "</td>";
            tableHtml += "<td>" + dataInbentarioa[i]["erosketaData"] + "</td></tr>";
        }
        document.getElementById("showDataInbentarioa").innerHTML = tableHtml;
        console.log(dataInbentarioa);
    }
}



//LLAMAR A LAS FUNCIONES AL CARGAR LA PAGINA
window.addEventListener("load", function(){
    //getDataFromURL("http://localhost/erronka1/controller/ekipamenduacontroller.php", "ekipamenduaTable");
    getDataFromURL("ekipamenduaTable");
    getDataFromURL("inbentarioaTable");
});