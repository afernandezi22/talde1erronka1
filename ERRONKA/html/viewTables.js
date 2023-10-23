// var data = [];
// var dataTable = 10;
// var actualPag = 1;

//DATOS DE LA TABLA ACTUAL
let tableData = [];
let tableLines = 10;
// let actualPag = 1;
let kokalekuaActualPag = 1;
let ekipamenduaActualPag = 1;
let kategoriaActualPag = 1;
let gelaActualPag = 1;
let inbentarioaActualPag = 1;
let erabiltzaileaActualPag = 1;


//FUNCION PARA PAGINAR --> DIVIDIR LOS DATOS EN TABLAS DE 10 LINEAS
function paginar(direccion, tableId) {
    let actualPag = 0;
    let totalPages = Math.ceil(tableData.length / tableLines);
    

    if (tableId === "ekipamendua") {
        actualPag = ekipamenduaActualPag;
    } else if (tableId === "inbentarioa") {
        actualPag = inbentarioaActualPag;


        /*if (actualPag * tableLines > tableData.length) {
            return;
        }*/


    } //else if (tableId === "")



    actualPag += direccion;
    if (actualPag < 1) {
        actualPag = 1;
    }
    if (actualPag > totalPages) {
        actualPag = totalPages;
    }





    if (tableId === "ekipamendua") {
        ekipamenduaActualPag = actualPag;
        viewTableEkipamendua(ekipamenduaActualPag);
    } else if (tableId === "inbentarioa") {
        inbentarioaActualPag = actualPag;
        viewTableInbentarioa(inbentarioaActualPag);
    }


    // displayTable();
    document.getElementById("page-number").innerHTML = actualPag;
    document.getElementById("total-pages").innerHTML = totalPages;
    //}

    //function displayTable() {
    //const ekipamenduaTable = document.getElementById("ekipamenduaTable");
    //const inbentarioaTable = document.getElementById("inbentarioaTable");

    // if (ekipamenduaTable) {
    //     viewTableEkipamendua(ekipamenduaActualPag);
    //     console.log(ekipamenduaActualPag);
    // } else if (inbentarioaTable) {
    //     viewTableInbentarioa(inbentarioaActualPag);
    // } else if (kokalekuaTable) {
    //     viewTableKokalekua(kokalekuaActualPag);
    // }
}

//MOSTRAR LOS DATOS DESEADOS DEL JSON --> PARA EKIPAMENDUA
function viewTableEkipamendua(actualPag) {
    var tableHtml = "";
    var start = (actualPag - 1) * tableLines;
    var end = start + tableLines;
    var ekipamenduaData = tableData.slice(start, end);

    for (var i = 0; i < ekipamenduaData.length; i++) {
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


//MOSTRAR LOS DATOS DESEADOS DEL JSON --> PARA INBENTARIOA
function viewTableInbentarioa(actualPag) {
    var tableHtml = "";
    var start = (actualPag - 1) * tableLines;
    var end = start + tableLines;
    var inbentarioaData = tableDataInbentarioa.slice(start, end);

    for (var i = 0; i < inbentarioaData.length; i++) {
        tableHtml += "<tr><td><input type='checkbox'></td>";
        tableHtml += "<td>" + inbentarioaData[i]["etiketa"] + "</td>";
        tableHtml += "<td>" + inbentarioaData[i]["idEkipamendu"] + "</td>";
        tableHtml += "<td>" + inbentarioaData[i]["erosketaData"] + "</td></tr>";

    }
    document.getElementById("showDataInbentarioa").innerHTML = tableHtml;
}


//MOSTRAR LOS DATOS DESADOS DEL JSON --> PARA KOKALEKUA
function viewTableKokalekua(actualPag) {
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

function getDataFromURL(url, tableId) {
    //let url = "http://localhost/erronka1/controller/ekipamenduacontroller.php";
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error ("ERROR: No se pudo obtener el JSON");
            }
            return response.json();
        })
        .then(data => {
            if (tableId == "ekipamendua") {
                tableData = data;
                viewTableEkipamendua(ekipamenduaActualPag);
            } else if (tableId == "inbentarioa") {
                tableDataInbentarioa = data;
                viewTableInbentarioa(inbentarioaActualPag);
            }
        })
        .catch(error => {
            console.error("ERROR:", error);
        })
}

//PRUEBA DE QUE FUNCIONA CON DATOS DE JSON, hay que pasarle el JSON de la BD
/*tableData = [
    {
        "id": "pruebaID168769",
        "izena": "pruebaIzena",
        "deskribapena": "pruebaDeskrib",
        "marka": "pruebaMarka",
        "modelo": "pruebaModelo",
        "stock": "pruebaStock",
        "etiketa": "a1",
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

tableDataInbentarioa = [
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
]*/

// window.addEventListener("load", paginar(0,any));
window.addEventListener("load", function() {
    paginar(1);
    viewTableEkipamendua(ekipamenduaActualPag);
    viewTableInbentarioa(inbentarioaActualPag);
    getDataFromURL("http://localhost/erronka1/controller/ekipamenduacontroller.php", "ekipamendua");
});