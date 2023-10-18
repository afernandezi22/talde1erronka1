var data = [];
var dataTable = 10;
var actualPag = 1;

//DIVIDIR LOS DATOS EN TABLAS DE 10 LINEAS
function paginar(direccion) {
    actualPag += direccion;
    if (actualPag < 1) {
        actualPag = 1;
    }

    if (actualPag > Math.ceil(data.length / dataTable)) {
        actualPag = Math.ceil(data.length / dataTable);
    }
    viewTable(actualPag);
    document.getElementById("page-number").innerHTML = actualPag;
    document.getElementById("total-pages").innerHTML = Math.ceil(data.length / dataTable)
}

//MOSTRAR LOS DATOS DESEADOS DEL JSON --> PARA EKIPAMENDUA
function viewTable(actualPag) {
    var tableHtml = "";
    var start = (actualPag - 1) * dataTable;
    var end = start + dataTable;
    for (var i = start; i < end && i < data.length; i++) {
        tableHtml += "<tr><td>" + data[i]["id"] + "</td>";
        tableHtml += "<td>" + data[i]["izena"] + "</td>";
        tableHtml += "<td>" + data[i]["deskribapena"] + "</td>";
        tableHtml += "<td>" + data[i]["marka"] + "</td>";
        tableHtml += "<td>" + data[i]["modelo"] + "</td>";
        tableHtml += "<td>" + data[i]["stock"] + "</td></tr>";
    }
    document.getElementById("showData").innerHTML = tableHtml;
}

//FUNCIONES PARA ABRIR Y CERRAR EL MENU DESPLEGABE
function openNav(){
    document.getElementById("open-button").style.width = "250px";
}

function closeNav(){
    document.getElementById("close-button").style.width = "0";
}

//PRUEBA DE QUE FUNCIONA CON DATOS DE JSON, hay que pasarle el JSON de la BD
data = [
    {
        "id": "pruebaID1",
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

viewTable(actualPag);