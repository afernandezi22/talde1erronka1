// var data = [];
// var dataTable = 10;
// var actualPag = 1;

//DATOS DE LA TABLA ACTUAL
let tableData = [];
let tableLines = 10;
let actualPag = 1;


//FUNCION PARA PAGINAR --> DIVIDIR LOS DATOS EN TABLAS DE 10 LINEAS
function paginar(direccion) {
    actualPag += direccion;
    if (actualPag < 1) {
        actualPag = 1;
    }

    var totalPages = Math.ceil(tableData.length / tableLines);
    if (actualPag > totalPages) {
        actualPag = totalPages;
    }
    // window.addEventListener("load", displayTable);
    document.getElementById("page-number").innerHTML = actualPag;
    document.getElementById("total-pages").innerHTML = totalPages;
}

function displayTable() {
    const ekipamenduaTable = document.getElementById("ekipamenduaTable");
    const inbentarioaTable = document.getElementById("inbentarioaTable");

    if (ekipamenduaTable) {
        viewTableEkipamendua(actualPag);
    } else if (inbentarioaTable) {
        viewTableInbentarioa(actualPag);
    } else if (kokalekuaTable) {
        viewTableKokalekua(actualPag);
    }
}

//MOSTRAR LOS DATOS DESEADOS DEL JSON --> PARA EKIPAMENDUA
function viewTableEkipamendua(actualPag) {

    var ekipamenduaData = tableData.slice((actualPag - 1) * tableLines, actualPag * tableLines);

    var tableHtml = "";
    // var start = (actualPag - 1) * tableLines;
    // var end = start + tableLines;

    // for (var i = start; i < end && i < ekipamenduaData.length; i++) {
    for (var i = 0; i < ekipamenduaData.length; i++){  
        tableHtml += "<tr><td><input type='checkbox'></td>"
        tableHtml += "<td>" + ekipamenduaData[i]["id"] + "</td>";
        tableHtml += "<td>" + ekipamenduaData[i]["izena"] + "</td>";
        tableHtml += "<td>" + ekipamenduaData[i]["deskribapena"] + "</td>";
        tableHtml += "<td>" + ekipamenduaData[i]["marka"] + "</td>";
        tableHtml += "<td>" + ekipamenduaData[i]["modelo"] + "</td>";
        tableHtml += "<td>" + ekipamenduaData[i]["stock"] + "</td></tr>";
    }
    document.getElementById("showDataEkipamendua").innerHTML = tableHtml;
}

function viewTableInbentarioa() {
    var inbentarioaData = tableData.slice((actualPag - 1) * tableLines, actualPag * tableLines);

    var tableHtml = "";
    var start = (actualPag - 1) * tableLines;
    var end = start + tableLines;

    for (var i = start; i < end && i < inbentarioaData.length; i++) {
        tableHtml += "<tr><td><input type='checkbox'></td>";
        tableHtml += "<td>" + inbentarioaData[i]["etiketa"] + "</td>";
        tableHtml += "<td>" + inbentarioaData[i]["idEkipamendu"] + "</td>";
        tableHtml += "<td>" + inbentarioaData[i]["erosketaData"] + "</td></tr>";
    }
    document.getElementById("showDataInbentarioa").innerHTML = tableHtml;
}


function viewTableKokalekua(actualPag){
    var kokalekuaData = tableData.slice((actualPag - 1) * tableLines, actualPag * tableLines);
    
    var tableHtml = "";
    var start = (actualPag - 1) * tableLines;
    var end = start + tableLines;

    for (var i = start; i < end && i < kokalekuaData.length; i++) {
        tableHtml += "<tr><td><input type='checkbox'></td>";
        tableHtml += "<td>" + kokalekuaData[i]["etiketa"] + "</td>";
        tableHtml += "<td>" + kokalekuaData[i]["idGela"] + "</td>";
        tableHtml += "<td>" + kokalekuaData[i]["hasieraData"] + "</td>";
        tableHtml += "<td>" + kokalekuaData[i]["amaieraData"] + "</td></tr>";
    }

    document.getElementById("showDataKokalekua").innerHTML = tableHtml;

}

//PRUEBA DE QUE FUNCIONA CON DATOS DE JSON, hay que pasarle el JSON de la BD
tableData = [
    {
        "id": "pruebaID168769",
        "izena": "pruebaIzena",
        "deskribapena": "pruebaDeskrib",
        "marka": "pruebaMarka",
        "modelo": "pruebaModelo",
        "stock": "pruebaStock",
    },
    {
        "id": "pruebaID2",
        "izena": "pruebaIzena",
        "deskribapena": "pruebaDeskrib",
        "marka": "pruebaMarka",
        "modelo": "pruebaModelo",
        "stock": "pruebaStock",
    },
    {
        "id": "pruebaID3",
        "izena": "pruebaIzena",
        "deskribapena": "pruebaDeskrib",
        "marka": "pruebaMarka",
        "modelo": "pruebaModelo",
        "stock": "pruebaStock",
    },
    {
        "id": "pruebaID4",
        "izena": "pruebaIzena",
        "deskribapena": "pruebaDeskrib",
        "marka": "pruebaMarka",
        "modelo": "pruebaModelo",
        "stock": "pruebaStock",
    },
    {
        "id": "pruebaID5",
        "izena": "pruebaIzena",
        "deskribapena": "pruebaDeskrib",
        "marka": "pruebaMarka",
        "modelo": "pruebaModelo",
        "stock": "pruebaStock",
    },
    {
        "id": "pruebaID6",
        "izena": "pruebaIzena",
        "deskribapena": "pruebaDeskrib",
        "marka": "pruebaMarka",
        "modelo": "pruebaModelo",
        "stock": "pruebaStock",
    },
    {
        "id": "pruebaID7",
        "izena": "pruebaIzena",
        "deskribapena": "pruebaDeskrib",
        "marka": "pruebaMarka",
        "modelo": "pruebaModelo",
        "stock": "pruebaStock",
    },
    {
        "id": "pruebaID8",
        "izena": "pruebaIzena",
        "deskribapena": "pruebaDeskrib",
        "marka": "pruebaMarka",
        "modelo": "pruebaModelo",
        "stock": "pruebaStock",
    }, {
        "id": "pruebaID9",
        "izena": "pruebaIzena",
        "deskribapena": "pruebaDeskrib",
        "marka": "pruebaMarka",
        "modelo": "pruebaModelo",
        "stock": "pruebaStock",
    },
    {
        "id": "pruebaID10",
        "izena": "pruebaIzena",
        "deskribapena": "pruebaDeskrib",
        "marka": "pruebaMarka",
        "modelo": "pruebaModelo",
        "stock": "pruebaStock",
    },
    {
        "id": "pruebaID11",
        "izena": "pruebaIzena",
        "deskribapena": "pruebaDeskrib",
        "marka": "pruebaMarka",
        "modelo": "pruebaModelo",
        "stock": "pruebaStock",
    },
    {
        "id": "pruebaID12",
        "izena": "pruebaIzena",
        "deskribapena": "pruebaDeskrib",
        "marka": "pruebaMarka",
        "modelo": "pruebaModelo",
        "stock": "pruebaStock",
    },
    {
        "id": "pruebaID13",
        "izena": "pruebaIzena",
        "deskribapena": "pruebaDeskrib",
        "marka": "pruebaMarka",
        "modelo": "pruebaModelo",
        "stock": "pruebaStock",
    },
    {
        "id": "pruebaID1",
        "izena": "pruebaIzena",
        "deskribapena": "pruebaDeskrib",
        "marka": "pruebaMarka",
        "modelo": "pruebaModelo",
        "stock": "pruebaStock",
    },
    {
        "id": "pruebaID1",
        "izena": "pruebaIzena",
        "deskribapena": "pruebaDeskrib",
        "marka": "pruebaMarka",
        "modelo": "pruebaModelo",
        "stock": "pruebaStock",
    },
    {
        "id": "pruebaID1",
        "izena": "pruebaIzena",
        "deskribapena": "pruebaDeskrib",
        "marka": "pruebaMarka",
        "modelo": "pruebaModelo",
        "stock": "pruebaStock",
    },
    {
        "id": "pruebaID1",
        "izena": "pruebaIzena",
        "deskribapena": "pruebaDeskrib",
        "marka": "pruebaMarka",
        "modelo": "pruebaModelo",
        "stock": "pruebaStock",
    },
    {
        "id": "pruebaID1",
        "izena": "pruebaIzena",
        "deskribapena": "pruebaDeskrib",
        "marka": "pruebaMarka",
        "modelo": "pruebaModelo",
        "stock": "pruebaStock",
    },
    {
        "id": "pruebaID1",
        "izena": "pruebaIzena",
        "deskribapena": "pruebaDeskrib",
        "marka": "pruebaMarka",
        "modelo": "pruebaModelo",
        "stock": "pruebaStock",
    },
    {
        "id": "pruebaID1",
        "izena": "pruebaIzena",
        "deskribapena": "pruebaDeskrib",
        "marka": "pruebaMarka",
        "modelo": "pruebaModelo",
        "stock": "pruebaStock",
    },
    {
        "id": "pruebaID1",
        "izena": "pruebaIzena",
        "deskribapena": "pruebaDeskrib",
        "marka": "pruebaMarka",
        "modelo": "pruebaModelo",
        "stock": "pruebaStock",
    },
    {
        "id": "pruebaID1",
        "izena": "pruebaIzena",
        "deskribapena": "pruebaDeskrib",
        "marka": "pruebaMarka",
        "modelo": "pruebaModelo",
        "stock": "pruebaStock",
    },
    {
        "id": "pruebaID1",
        "izena": "pruebaIzena",
        "deskribapena": "pruebaDeskrib",
        "marka": "pruebaMarka",
        "modelo": "pruebaModelo",
        "stock": "pruebaStock",
    },
]

window.addEventListener("load", displayTable);