$("form").attr("action","#");

//Quand on va cliquer sur le bouton de connexion
$("#co").on("click",function(){
    var tata = $("#valueCo").val();

    $.ajax({
        method:"POST",
        url:"index_pdo.php",
        data:{"action":"co",
            "login":tata
        },
        success: function(r){
            console.log(r);
        }

    });
});

//Quand on va cliquer sur le bouton de déconnexion
$("#deco").on("click", function(){
    $.ajax({
        method:"POST"


    });
});

//
