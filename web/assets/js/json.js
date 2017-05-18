var cont = document.getElementById('info');
var btn = document.getElementById('btn');
var inp = document.getElementById('recherche');
var generer = document.getElementById('generer');

generer.addEventListener("click",function () {
    console.log("i m in");
    var soundRequest = new XMLHttpRequest();
    soundRequest.open('GET','http://localhost/pikarhabti/web/app_dev.php/ajax/parole');
    soundRequest.send();

});


btn.addEventListener("click",function () {
    var ourRequest = new XMLHttpRequest();
    ourRequest.open('GET','http://localhost/pikarhabti/web/app_dev.php/ajax/aff');
    ourRequest.onload= function () {

        var ourData = JSON.parse(ourRequest.responseText);

        console.log(ourData);
       var htmlString = ecrireHTML(ourData);
     //   cont.insertAdjacentHTML('beforeend',htmlString);
        $("tbody").html(htmlString);
    };

    ourRequest.send();
});

function ecrireHTML(ourData) {
    var htmlString="";
    for (i=0;i<=5;i++){

        htmlString = htmlString + '<tr>';

        htmlString = htmlString + '<td>'+ ourData[i].contenu +'</td>';

        htmlString = htmlString + '<td>'+ourData[i].typeQuest+'</td>';
        htmlString = htmlString + '<td>'+ourData[i].reponseCorrect+'</td>';

        htmlString = htmlString + '<td>'+ourData[i].choix1+'</td>';
        htmlString = htmlString + '<td>'+ourData[i].choix2+'</td>';
        htmlString = htmlString + '<td>'+ourData[i].choix3+'</td>';
        htmlString = htmlString + '<td data-id="'+ourData[i].id+'">';

        htmlString = htmlString + '<img src="/pikarhabti/web/images/Questionimages/'+ourData[i].image+'" width="150px" height="150px" alt="monimg" /></td>';

        htmlString = htmlString + '<td><button data-toggle="modal" data-target="#edit-item" class="btn btn-primary edit-item">Edit</button> ';

        htmlString = htmlString + '<button data-target="#remove-item" class="btn btn-danger remove-item">Delete</button>';

        htmlString = htmlString + '</td>';

        htmlString = htmlString + '</tr>';

    }
    return htmlString;
}


$("body").on("click",".edit-item",function(){

    var id = $(this).parent("td").prev("td").data('id');
    var contenu =  $(this).parent("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
    var typeQuestion = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
    var ReponseCorrect = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
    var choix1 = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").text();
    var choix2 = $(this).parent("td").prev("td").prev("td").prev("td").text();
    var choix3 = $(this).parent("td").prev("td").prev("td").text();
    var image = $(this).parent("td").prev("td").text();
    $("#edit-item").find("textarea[name='contenu']").val(contenu);
    $("#edit-item").find("input[name='TypeQuestion']").val(typeQuestion);
    $("#edit-item").find("input[name='ReponseCorrect']").val(ReponseCorrect);
    $("#edit-item").find("input[name='Choix1']").val(choix1);
    $("#edit-item").find("input[name='Choix2']").val(choix2);
    $("#edit-item").find("input[name='Choix3']").val(choix3);
    $("#edit-item").find(".edit-id").val(id);
    console.log(id);
});

$("body").on("click",".remove-item",function() {
    console.warn("test");
    console.log(0);

    var id = $(this).parent("td").prev("td").data('id');
    console.log(id);
    var effRequest = new XMLHttpRequest();
    effRequest.open('GET','http://localhost/pikarhabti/web/app_dev.php/ajax/'+id);
    effRequest.send();
    console.log(4);
    var evt = document.createEvent("MouseEvents");
    evt.initMouseEvent("click", true, true, window,0, 0, 0, 0, 0, false, false, false, false, 0, null);
    document.getElementById("btn").dispatchEvent(evt);
   // ourRequest.send();

    console.log(id);
});


if(window.addEventListener){
    window.addEventListener('load', maFonctionDeTest, false);
}else{
    window.attachEvent('onload', maFonctionDeTest);
}


$('#recherche').keyup( function(){

    var ourRequest = new XMLHttpRequest();
    ourRequest.open('GET','http://localhost/pikarhabti/web/app_dev.php/ajax/recherche/'+$(this).val());
    console.log($(this).val());
    ourRequest.onload= function () {

        var ourData = JSON.parse(ourRequest.responseText);

        console.log(ourData);
        var htmlString = ecrireHTML(ourData);
        //   cont.insertAdjacentHTML('beforeend',htmlString);
        $("tbody").html(htmlString);
    };

    ourRequest.send();

});

function maFonctionDeTest(){
    var evt = document.createEvent("MouseEvents");
    evt.initMouseEvent("click", true, true, window,0, 0, 0, 0, 0, false, false, false, false, 0, null);
    document.getElementById("btn").dispatchEvent(evt);
}

