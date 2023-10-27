export function paginar(data, actualPag, tableLines, direccion, renderFunction) {
    let totalPages = Math.ceil(data.length / tableLines);
    
    actualPag += direccion;
    if (actualPag < 1){
        actualPag = 1;
    }
    if (actualPag > totalPages){
        actualPag = totalPages;
    }

    renderFunction(data, actualPag);
    return {actualPag, totalPages};
}