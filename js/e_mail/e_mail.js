/**
 * Po načtení stránky se načtou příjmeci z _data_array listu
 */
function onLoad(){

    render_prijemci = document.getElementById("render_prijemci");

    console.log(_data_array);

    for(var x =0; x < _data_array.length;x++){

        append_prijemce(_data_array[x].id,_data_array[x].name,_data_array[x].email)

        }

}

function append_prijemce(id,name,email){
    if(!valid_email(email)){
        $( "#render_prijemci" ).append("<div class='es js_get' email='"+email+"' id='prijemciId_"+id+"'><a class='nevalidni'>"+email+"</a><a> ("+name+") </a><a class='remove' onclick=removeItem('"+id+"')>&times;</a><br> </div>");
        return;
    }
    $( "#render_prijemci" ).append("<div class='es js_get' email='"+email+"' id='prijemciId_"+id+"'><a>"+email+"</a><a> ("+name+") </a><a class='remove' onclick=removeItem('"+id+"')>&times;</a><br> </div>");
}

function removeItem(id){
    document.getElementById("prijemciId_"+id).remove();
}

function pridej(){

    var input = document.getElementById("pridat_prijemce").value;

    if(!valid_email(input)){
        alert("Nevalidní e-mail");
        return;
    }

    append_prijemce(input,"\"Přidáno ručně\"",input);
}

function odesli(){

    var prijemci = document.getElementsByClassName("js_get");

    var e_mailu = [];

    for(var x =0; x < prijemci.length;x++){

        e_mailu.push(prijemci[x].getAttribute("email"));

    }

    var predmet = document.getElementById("predmet").value;
    var text = document.getElementById("text").value;

    file = document.getElementById("priloha").files[0];

    var form_data = new FormData();
    form_data.append('emails_Json',JSON.stringify(e_mailu));
    form_data.append('img',file);
    form_data.append('text',text);
    form_data.append('predmet',predmet);
    $.ajax({
        url: 'a_sendData.php', // <-- point to server-side PHP script 
        dataType: 'text',  // <-- what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        success: function(php_script_response){// <-- display response from the PHP script, if any
           alert(php_script_response);
        }, error: function (e) {
            alert("CHABA 500\nněco se nepovedlo...");
          } 
    });

    


}
