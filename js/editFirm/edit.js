$(document).ready(function(){
    
    var id = $(".form").attr('id');

    var prevInputs = $(".form input").clone();
    var prevTextarea = $(".form textarea").clone();
    var prevSelect = $(".form select").clone();



    $("#send-button").click(function(e){
        e.preventDefault();
        var id = $(".form").attr('id');
        var changeCount = 0;
        changeCount += checkChange("input", prevInputs,id);
        changeCount += checkChange("textarea", prevTextarea,id);
        changeCount += checkChange("select", prevSelect,id);
        //console.log("Changes:"+ changeCount);
        if(changeCount != 0){
         // alert("ok")
        }
    }); 

    $("#delete").click(function(event){
        event.preventDefault();
        $("#complexConfirm").confirm();
        
    });
});

function checkChange(element,elementPrev,id){
    console.log(element);
    var elements = $(element);
    
    var changedElementsIndex = [];

    var json = '{"id":"'+id+'",';

    for(var x = 0;x < elements.length;x++){
        if($(elements[x]).val() != $(elementPrev[x]).val()){
            changedElementsIndex.push(x);
        }
    }

    if(changedElementsIndex.length != 0){
        for(var x = 0;x < changedElementsIndex.length;x++){
			
            var element = $(elements[changedElementsIndex[x]]);
			console.log (element);
                json += '"'+element.attr("name")+'":"'+element.val().trim()+'"';
                if(x != changedElementsIndex.length-1){
                    json += ",";
                }
        }
        json += "}";
    
        console.log(json);

        $.when($.ajax({
            url:"/editFirm/editFirm.php",
            method:"POST",
            data: JSON.parse(json),
            success:function(response) {
                console.log("OK");
                //console.log(response);  
                  
            },
            error:function(){
                alert("error64");
            }

         })).done(function(){
            updateRow(json);  
            return 1;
        });

    }else {
        return 0;
    }
    
    
}

function updateRow(json) {
d =JSON.parse(json);
console.log(d["id"]);
getFirmRow("/procedure.php",d["id"]);

}

/**
 * Function to check if is more than one selected, and have at least 1 e-mail
 * if so send ids to email/index.php
 * if not, show alert
 */
function send_e(){

    var selected = $(".check:checked");

    if (selected.length < 1){
        alert("Musíte vyplnit, alespoň jeden záznam.");
        return;
    }
    var array_id = [];
    var array_of_names = [];
    for (const tr of selected) {
        id = $(tr).attr('id');
        array_id.push(id);
        e_mail = document.getElementById("e_"+id).title
        console.log(e_mail)
        if (e_mail.length < 2){
            array_of_names.push(document.getElementById("name_"+id).title);
        }
    }

    if(array_of_names.length > 0){
        //js nemá string builder, ale neocekvam vic jak 100, takze OK
        string = "";
        for (const x in array_of_names){
            string = string + x + "\n\r";
        }

        alert("U těchto firem e-maily nejsou vyplněny\n"+array_of_names);
        return;

    }

    string = "";
    for (var x = 0; x < array_id.length; x ++){
        string = string + array_id[x] + ";";
    }

    window.open('e_mail?ids='+string, '_blank');

}
