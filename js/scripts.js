/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*Returns the jqXHR object*/
function setAjax(path) {
    return $.ajax({
             url : path,
             type: 'POST',
             data : $("#form").serialize()
    });
}

/*Determine what is done with the data when it is returned by the server */
function processData(response /*textStatus, jqXHR*/) {
    var response = JSON.parse(response),
        html = "";
    if(response.success) {
        html = "";
    }
}	

/* Obtain the data to be sent to the server and intiate Ajax*/
function doAjax(path) {
        //Pass the values to the AJAX request and specify function arg for 'done' callback
        ajax = setAjax(path);
        ajax.done(processData);
        ajax.fail(function( jqXHR, textStatus, errorThrown) {

        });
}




