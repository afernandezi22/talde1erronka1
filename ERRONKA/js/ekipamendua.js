window.addEventListener("load", function(){
    if(document.getElementById("ekipamenduaTable")!= undefined){
        getDataFromURL("ekipamenduaTable");
    }
});

function viewTable(dataAll, actualPag, tableId) {
    var tableHtml = "";
    var start = (actualPag - 1) * tableLines;
    var end = start + tableLines;

    for (let i = start; i < Math.min(end, tableData[tableId].data.length); i++) {
        if (tableId == "ekipamenduaTable"){
            tableHtml += "<tr><td><input type='checkbox' id=" + tableData[tableId].data[i]['id'] + "></td>";
            tableHtml += "<td>" + tableData[tableId].data[i]["id"] + "</td>";
            tableHtml += "<td>" + tableData[tableId].data[i]["izena"] + "</td>";
            tableHtml += "<td>" + tableData[tableId].data[i]["deskribapena"] + "</td>";
            tableHtml += "<td>" + tableData[tableId].data[i]["marka"] + "</td>";
            tableHtml += "<td>" + tableData[tableId].data[i]["modelo"] + "</td>";
            tableHtml += "<td>" + tableData[tableId].data[i]["stock"] + "</td></tr>";
        }
    }
    
    //console.log("tableHtml" + tableHtml);
    document.getElementById("showDataEkipamendua").innerHTML = tableHtml;
}