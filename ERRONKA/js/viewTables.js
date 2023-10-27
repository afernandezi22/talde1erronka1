function paginar(data, actualPage, tableLines) {
    const start = (actualPage - 1) * tableLines;
    const end = start + tableLines;
    return data.slice(start, end);
}

function renderTable(data, tableElement) {
    let tableHtml = "";

    for (const item of data) {
        tableHtml += "<tr><td><input type='checkbox'></td>";
        // Render the table rows based on your data structure
        // Modify this part as per your data structure
        tableHtml += "<td>" + item["field1"] + "</td>";
        tableHtml += "<td>" + item["field2"] + "</td>";
        // Add more fields as needed
        tableHtml += "</tr>";
    }

    tableElement.innerHTML = tableHtml;
}

function fetchDataAndRenderTable(url, tableElement, tableLines, actualPage) {
    fetch(url, { method: "GET", mode: 'cors' })
        .then(response => response.json())
        .then(data => {
            const paginatedData = paginateTable(data, actualPage, tableLines);
            renderTable(paginatedData, tableElement);
        })
        .catch(err => console.error("ERROR: " + err.message));
}

// Export the functions
export { paginateTable, renderTable, fetchDataAndRenderTable };