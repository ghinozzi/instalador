function jsonToOptions(array,id,description){
    let campos = [];
    campos.push("<option value=''>Selecione</option>");
    for(var i = 0;i<array.length;i++){
        campos.push("<option value='"+array[i][id]+"'>"+array[i][description]+"</option>");
    }
    let response = campos.join('\n');
    return response;
}
