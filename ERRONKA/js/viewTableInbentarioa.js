var dataInbentarioa = [];
const tableLines = 10;
var actualPag = 1;

//PAGINAR LA TABLA INBENTARIOA
function paginarInbentarioa(direccion) {
    let totalPages = Math.ceil(dataInbentarioa.length / tableLines);

    actualPag += direccion;
    if (actualPag < 1) {
        actualPag = 1;
    }
    if (actualPag > totalPages) {
        actualPag = totalPages;
    }

    viewTableInbentarioa(dataInbentarioa, actualPag);

    document.getElementById("page-number").innerHTML = actualPag;
    document.getElementById("total-pages").innerHTML = totalPages;
}

function getDataFromURL(url) {
    var options = {method: "GET", mode: 'cors'};
    fetch(url, options)
        .then(response => response.json())
        .then(data => {
            dataInbentarioa = data;
            totalPages = Math.ceil(dataInbentarioa.length / tableLines);
            paginarInbentarioa(0);

        })
        .catch(err => {
            console.error("ERROR: " + err.message);
        })
}

function viewTableInbentarioa(dataInbentarioa, actualPag) {
    var tableHtml = "";
    var start = (actualPag - 1) * tableLines;
    var end = start + tableLines;

    for (var i = 0; i < dataInbentarioa.length; i++){
        tableHtml += "<tr><td><input type='checkbox'></td>";
        tableHtml += "<td>" + dataInbentarioa[i]["etiketa"] + "</td>";
        tableHtml += "<td>" + dataInbentarioa[i]["idEkipamendu"] + "</td>";
        tableHtml += "<td>" + dataInbentarioa[i]["erosketaData"] + "</td></tr>";
    }
    document.getElementById("showDataInbentarioa").innerHTML = tableHtml;
    console.log(tableHtml);
}

window.addEventListener("load", function(){
    getDataFromURL("http://localhost/erronka1/controller/inbentarioacontroller.php");
})