//DATOS DE LA TABLA ACTUAL
let tableData = {
    ekipamendua: [],
    inbentarioa: [],
    kategoria: [],
    gela: [],
    erabiltzailea: [],
    kokalekua: []
};

const tableLines = 10;
//PAGINA ACTUAL PARA CADA TABLA
/*let kokalekuaActualPag = 1;
let ekipamenduaActualPag = 1;
let kategoriaActualPag = 1;
let gelaActualPag = 1;
let inbentarioaActualPag = 1;
let erabiltzaileaActualPag = 1;*/
let tableActualPag = {
    ekipamendua: 1,
    inbentarioa: 1,
    kategoria: 1,
    gela: 1,
    erabiltzailea: 1,
    kokalekua: 1
}

//DATOS PARA CADA TABLA
let ekipamenduaData = [];
let inbentarioaData = [];



//FUNCION PARA PAGINAR --> DIVIDIR LOS DATOS EN TABLAS DE 10 LINEAS
function paginar(direccion, tableId) {
    let actualPag = tableActualPag[tableId];
    let tableDataArray = tableData[tableId];

    /*if(!tableDataArray) {
        console.error(`No se encontraron datos para la tabla ${tableId}`);
    }*/

    let totalPages = Math.ceil(tableDataArray.length / tableLines);

    let newActualPag = actualPag + direccion;

    //actualPag += direccion;
    if (newActualPag < 1) {
        newActualPag = 1;
    }
    if (newActualPag > totalPages) {
        newActualPag = totalPages;
    }


    tableActualPag[tableId] = newActualPag;
    viewTable(tableId);


    /*if (tableId === "ekipamendua") {
        ekipamenduaActualPag = actualPag;
        viewTableEkipamendua(ekipamenduaActualPag);
    } else if (tableId === "inbentarioa") {
        inbentarioaActualPag = actualPag;
        viewTableInbentarioa(inbentarioaActualPag);
    }*/


    // displayTable();
    document.getElementById("page-number").innerHTML = newActualPag;
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

//PRUEBA
function viewTable(tableId) {
    var tableHtml = [];
    var start = (tableActualPag[tableId] - 1) * tableLines;
    var end = start + tableLines;

    //var data = tableData[tableId].slice(start, end);
    var data = tableData.ekipamendua.slice(start,end);
    //console.log(data);

    data.forEach(item => {
        let rowHtml = '<tr><td><input type="checkbox"></td>';
        for (const key in item) {
            rowHtml += `<td>${item[key]}</td>`;
        }
        rowHtml += '</tr>';
        tableHtml.push(rowHtml);
    });
    document.getElementById(`showData_${tableId}`).innerHTML = tableHtml.join('');
    
}

//MOSTRAR LOS DATOS DESEADOS DEL JSON --> PARA EKIPAMENDUA
/*function viewTableEkipamendua(actualPag) {
    var tableHtml = "";
    var start = (actualPag - 1) * tableLines;
    var end = start + tableLines;
    var ekipamenduaData = ekipamenduaData.slice(start, end);

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
}*/


//MOSTRAR LOS DATOS DESEADOS DEL JSON --> PARA INBENTARIOA
/*function viewTableInbentarioa(actualPag) {
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
}*/


//MOSTRAR LOS DATOS DESADOS DEL JSON --> PARA KOKALEKUA
/*function viewTableKokalekua(actualPag) {
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

}*/

function getDataFromURL() {
    let url = "http://localhost/erronka1/controller/ekipamenduacontroller.php";
    let options = {method: "GET"};
    fetch(url, options)
        .then(response => {
           /*  if (!response.ok) {
                throw new Error ('ERROR: No se pudo obtener el JSON');
            } */
            return response.json();
            console.log(response);
        })
        .then(data => {
            tableData.ekipamendua = data;
            console.log(tableData.ekipamendua);
            //tableActualPag[tableId] = 1;
            viewTable('ekipamendua');
        })
        .catch(err => {
            console.error("ERROR:" + err.message);
        })
}

//PRUEBA DE QUE FUNCIONA CON DATOS DE JSON, hay que pasarle el JSON de la BD
/*

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
// window.addEventListener("load", function() {
//     paginar(1);
//     viewTableEkipamendua(ekipamenduaActualPag);
//     viewTableInbentarioa(inbentarioaActualPag);
//     getDataFromURL("http://localhost/erronka/controller/ekipamenduacontroller.php", "ekipamendua");
// });


window.addEventListener("load", function () {
    paginar(1, 'ekipamendua');
    paginar(1, 'inbentarioa');
    
    getDataFromURL();
    //getDataFromURL('http://localhost/erronka/controller/ekipamenduacontroller.php', 'ekipamendua');
    /*getDataFromURL('http://localhost/erronka/controller/inbentarioacontroller.php', 'inbentarioa');
    // Agrega llamadas a paginar para las demás tablas
    getDataFromURL('http://localhost/erronka1/controller/kategoriacontroller.php?id=001', 'kategoria');
    getDataFromURL('http://localhost/erronka/controller/gelacomcontroller.php', 'gela');
    getDataFromURL('http://localhost/erronka/controller/erabiltzaileacomcontroller.php', 'erabiltzailea');*/
});