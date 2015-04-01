$("form").attr("action","#");

//Quand on va cliquer sur le bouton de connexion
$("#co").on("click",function(){
    $.ajax({
        method:"POST",
        url:"index_pdo.php",
        data:{"action":"co",
            "login":$("#valueCo").value,
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
