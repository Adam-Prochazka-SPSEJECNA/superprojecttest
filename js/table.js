function valid_email(e){return!!e.match(/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)}$(document).ready(function(){var e=document.cookie.split(";"),t="";for(let a of e)if(a.includes("search=")){t=a.split("=")[1];break}$("#basic").DataTable({dom:"lBftrip",buttons:["colvis","excel","print"],scrollX:"auto",lengthMenu:[[-1,10,20,50,100],["All",10,20,50,100],],stateSave:!0,scrollY:"700px",scrollCollapse:!0,search:{search:t},columnDefs:[{targets:0,orderable:!1}],language:{search:"",searchPlaceholder:"Vyhled\xe1v\xe1n\xed"},initComplete:function(e,t){$(".dataTables_scrollBody").height($(window).innerHeight()-180)}}),$(".dataTables_length").append($('<div class="table-filter"> <label>Aktivn\xed:<input type="checkbox" checked="checked" id="check-active"></label><button id="edit-btn" class="bn49">Upravit vybran\xe9</button><button class="bn49" id="delete-btn">Vymazat vybran\xe9</button><button class="bn49" id="export-btn">Exportovat vybran\xe9</button> | <a class="bn49" href="/firms/insertFirmForm.php">Přid\xe1n\xed Firmy</a><a class="bn49 " href="/columns/columnForm.php">\xdapravy sloupců</a><a class="bn49 " href="/events/tableEvents.php">Ud\xe1losti</a> <a onclick="send_e()" class="bn49 ">Poslat hromadn\xfd-email</a></div>')),$("#basic").DataTable().on("search.dt",function(){var e=$("#basic_filter label input").val();""==e?r(""):(r(e),window.history.replaceState&&window.history.replaceState("","CRM",window.location.origin+"?search="+e))});var n=$("#check-active");function r(e){let t=new Date;t.setTime(t.getTime()+432e5);let a="expires="+t.toUTCString();document.cookie="search="+e+";"+a}n.on("change",function(){!0==n.prop("checked")?$("#basic").DataTable().column(4).search("1",!0,!1,!0).draw():$("#basic").DataTable().column(4).search("0",!0,!1,!0).draw()}),$("#delete-btn").click(function(){var e=$(".check:checked");if(e.length>0)$.confirm({title:"Opravdu chcete smazat tyto firmy ?",content:"Smazat "+e.length+" firem?",buttons:{yes:{text:"Ano",btnClass:"btn-blue",keys:["enter","shift"],action:function(){var t=[];for(let a of e)t.push($(a).attr("id"));console.log(t),$.ajax({url:"/firms/deleteFirms.php",method:"POST",data:{ids:t},success:function(e){for(var a=0;a<t.length;a++)document.getElementById(t[a]).remove();alert("Povedlo se smazat")},error:function(){alert("error")}})}},no:{text:"Ne",btnClass:"btn-gray",keys:["enter","shift"],action:function(){}}}});else{alert("Mus\xedte vybrat alespoň firmu");return}}),$("#export-btn").click(function(){var e=$(".selected");if(e.length>0){var t=[];for(let a of e)t.push($(a).attr("id"));console.log(t);var n=document.createElement("form");n.method="POST",n.action="/firms/exportFirms.php";var r=document.createElement("input");r.value=JSON.stringify({ids:t}),r.name="ids",r.type="hidden",n.appendChild(r),document.body.appendChild(n),n.submit()}})}),$(window).resize(function(){$(".dataTables_scrollBody").height($(window).innerHeight()-180)});