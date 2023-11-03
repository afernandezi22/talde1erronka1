window.addEventListener("load", function(){
    if (document.getElementById("gelaTable") != undefined){
        getDataFromURL("gelaTable");
    }
});

function viewTable(dataAll, actualPag, tableId) {
    var tableHtml = "";
    var start = (actualPag - 1) * tableLines;
    var end = start + tableLines;

    for (let i = start; i < Math.min(end, tableData[tableId].data.length); i++) {
        if (tableId == "gelaTable") {
            tableHtml += "<tr><td><input type='checkbox' id=" + tableData[tableId].data[i]['id'] + "></td>";
            tableHtml += "<td>" + tableData[tableId].data[i]["izena"] + "</td>";
            tableHtml += "<td>" + tableData[tableId].data[i]["taldea"] + "</td></tr>";
        }
    }
    document.getElementById("showDataGela").innerHTML = tableHtml;
    //console.log(tableHtml);
}