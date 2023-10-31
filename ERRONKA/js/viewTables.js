// LLAMAR A LAS FUNCIONES AL CARGAR LA PÁGINA
window.addEventListener("load", function(){
    if(document.getElementById("ekipamenduaTable")!= undefined){
        getDataFromURL("ekipamenduaTable");
    } else if (document.getElementById("gelaTable") != undefined){
        getDataFromURL("gelaTable");
    } else if (document.getElementById("inbentarioaTable") != undefined){
        getDataFromURL("inbentarioaTable");
    } else if (document.getElementById("kategoriaTable") != undefined){
        getDataFromURL("kategoriaTable");
    } else if (document.getElementById("kokalekuaTable") != undefined){
        getDataFromURL("kokalekuaTable");
    }
});

var tableData = {
    'ekipamenduaTable': {
        data: [],
        totalPages: 0,
        actualPag: 1
    },
    'gelaTable': {
        data: [],
        totalPages: 0,
        actualPag: 1
    },
    'inbentarioaTable': {
        data: [],
        totalPages: 0,
        actualPag: 1
    },
    'kategoriaTable': {
        data: [],
        totalPages: 0,
        actualPag: 1
    },
    'kokalekuaTable': {
        data: [],
        totalPages: 0,
        actualPag: 1
    }
};

const tableLines = 10;

// PAGINAR LAS TABLAS
function paginar(direccion, tableId) {
    var table = tableData[tableId];

    table.actualPag += direccion;
    if (table.actualPag < 1) {
        table.actualPag = 1;
    }
    if (table.actualPag > table.totalPages) {
        table.actualPag = table.totalPages;
    }

    viewTable(table.data, table.actualPag, tableId);

    document.getElementById("page-number").innerHTML = table.actualPag;
    document.getElementById("total-pages").innerHTML = table.totalPages;
}

// OBTENER LOS DATOS DEL JSON USANDO FETCH
function getDataFromURL(tableId) {
    var options = { method: "GET", mode: 'cors' };
    var url = "";

    if (tableId == "ekipamenduaTable"){
        url = "http://localhost/erronka1/controller/ekipamenduacontroller.php";
    } else if (tableId == "gelaTable"){
        url = "http://localhost/erronka1/controller/gelacontroller.php";
    } else if (tableId == "inbentarioaTable"){
        url = "http://localhost/erronka1/controller/inbentarioacontroller.php";
    } else if (tableId == "kategoriaTable"){
        url = "http://localhost/erronka1/controller/kategoriacontroller.php";
    } else if (tableId == "kokalekuaTable"){
        url = "http://localhost/erronka1/controller/kokalekuacontroller.php";
    } else {
        console.error("ERROR: Invalid tableID");
        return;
    }

    fetch(url, options)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            var table = tableData[tableId];
            table.data = data;

            table.totalPages = Math.ceil(data.length / tableLines);
            paginar(0, tableId);  // Para asegurar que se inicie en la página 1
        })
        .catch(err => {
            console.error("ERROR: " + err.message);
        });
}

// FUNCION PARA MOSTRAR LOS DATOS EN FORMATO TABLA
function viewTable(dataAll, actualPag, tableId) {
    var tableHtml = "";
    var start = (actualPag - 1) * tableLines;
    var end = start + tableLines;
    
    // DARLE EL FORMATO DE TABLA A LOS DATOS SEGÚN EL ID DE LA TABLA
    for (let i = start; i < Math.min(end, tableData[tableId].data.length); i++) {
        if (tableId == "ekipamenduaTable"){
            tableHtml += "<tr><td><input type='checkbox' id=" + tableData[tableId].data[i]['id'] + "></td>";
            tableHtml += "<td>" + tableData[tableId].data[i]["id"] + "</td>";
            tableHtml += "<td>" + tableData[tableId].data[i]["izena"] + "</td>";
            tableHtml += "<td>" + tableData[tableId].data[i]["deskribapena"] + "</td>";
            tableHtml += "<td>" + tableData[tableId].data[i]["marka"] + "</td>";
            tableHtml += "<td>" + tableData[tableId].data[i]["modelo"] + "</td>";
            tableHtml += "<td>" + tableData[tableId].data[i]["stock"] + "</td></tr>";
        } else if (tableId == "gelaTable") {
            tableHtml += "<tr><td><input type='checkbox' id=" + tableData[tableId].data[i]['id'] + "></td>";
            tableHtml += "<td>" + tableData[tableId].data[i]["izena"] + "</td>";
            tableHtml += "<td>" + tableData[tableId].data[i]["taldea"] + "</td></tr>";
        } else if (tableId == "inbentarioaTable") {
            tableHtml += "<tr><td><input type='checkbox' id=" + tableData[tableId].data[i]['etiketa'] + "></td>";
            tableHtml += "<td>" + tableData[tableId].data[i]["etiketa"] + "</td>";
            tableHtml += "<td>" + tableData[tableId].data[i]["idEkipamendu"] + "</td>";
            tableHtml += "<td>" + tableData[tableId].data[i]["erosketaData"] + "</td></tr>";
        } else if (tableId == "kategoriaTable") {
            tableHtml += "<tr><td><input type='checkbox' id=" + tableData[tableId].data[i]['izena'] + "></td>";
            tableHtml += "<td>" + tableData[tableId].data[i]["izena"] + "</td>";
            tableHtml += "<td>" + tableData[tableId].data[i]["taldea"] + "</td></tr>";
        } else if (tableId == "kokalekuaTable") {
            tableHtml += "<tr><td><input type='checkbox' id=" + tableData[tableId].data[i]['etiketa'] + "></td>";
            tableHtml += "<td>" + tableData[tableId].data[i]["etiketa"] + "</td>";
            tableHtml += "<td>" + tableData[tableId].data[i]["idGela"] + "</td>";
            tableHtml += "<td>" + tableData[tableId].data[i]["hasieraData"] + "</td>";
            tableHtml += "<td>" + tableData[tableId].data[i]["amaieraData"] + "</td></tr>";
        } else {
            console.error("ERROR: Invalid tableID");
            return;
        }
    }

    // ESCRIBIR EN LA TABLA LOS DATOS DEL JSON
    if (tableId == "ekipamenduaTable") {
        document.getElementById("showDataEkipamendua").innerHTML = tableHtml;
    } else if (tableId == "gelaTable") {
        document.getElementById("showDataGela").innerHTML = tableHtml;
    } else if (tableId == "inbentarioaTable") {
        document.getElementById("showDataInbentarioa").innerHTML = tableHtml;
    } else if (tableId == "kategoriaTable") {
        document.getElementById("showDataKategoria").innerHTML = tableHtml;
    } else if (tableId == "kokalekuaTable") {
        document.getElementById("showDataKokalekua").innerHTML = tableHtml;
    } else {
        console.error("ERROR: Invalid tableID");
        return;
    }
}

