//GEHITZEKO LOGIKA
const gehituContainer = document.getElementById("gehituContainer");
const gehituButton = document.getElementById("gehitu");
const itxiGehituPopup = document.getElementById("itxiGehituPopup");
const gehituForm = document.getElementById("gehituForm");

gehituButton.addEventListener("click", function () {
    gehituContainer.style.display = "block";
});

itxiGehituPopup.addEventListener("click", function () {
    gehituContainer.style.display = "none";
});

gehituForm.addEventListener("submit", function (e) {
    e.preventDefault();
    // Aquí puedes agregar lógica para manejar el formulario, por ejemplo, enviar los datos a través de AJAX.
    // Después de procesar el formulario, puedes cerrar la ventana emergente.
    gehituContainer.style.display = "none";
});

//EDITATZEKO LOGIKA


//PAGINATZEKO LOGIKA
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

function getData() {
    fetch('http://localhost/erronka1/controller/kategoriacontroller.php', {
    method: 'GET',
    headers: {
        'Content-Type': 'application/json'
    },
    })
    .then(response => {
        return response.json();
    })
    .then(data => {
        dataInbentarioa = data;
        totalPages = Math.ceil(dataInbentarioa.length / tableLines);
        paginarInbentarioa(0); // Para asegurar que se inicie en la página 1
    })
    .catch(err => {
        console.error("ERROR: " + err.message);
    })
}

function viewTableInbentarioa(dataInbentarioa, actualPag) {
    var tableHtml = "";
    var start = (actualPag - 1) * tableLines;
    var end = start + tableLines;

    for (var i = start; i < Math.min(end, dataInbentarioa.length); i++){
        tableHtml += "<tr><td><input type='checkbox' id=" + dataInbentarioa[i]["id"] + "></td>";
        tableHtml += "<td>" + dataInbentarioa[i]["id"] + "</td>";
        tableHtml += "<td>" + dataInbentarioa[i]["izena"] + "</td></tr>";
    }
    document.getElementById("showDataInbentarioa").innerHTML = tableHtml;
    // console.log(tableHtml);
}

window.addEventListener("load", function(){
    getData();
})