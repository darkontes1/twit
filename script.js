$("body").find("#container").children("form").attr("action","#");

//Quand on va cliquer sur le bouton de connexion
$(document).on("click","#co",function(){
    var tata = $("#valueCo").val();
    $.ajax({
        method:"POST",
        url:"index_pdo.php",
        data:{"action":"co",
            "login":tata
        },
        success:function(r){
            //console.log(r);
        }
    });
});

//Quand on va cliquer sur le bouton de déconnexion
$(document).on("click", "#deco", function(){
    $.ajax({
        method: "POST",
        url: "index_pdo.php",
        data: {"action":"deco"},
        success : function(r){}
    });
});

$(document).on("click","#retweet", function(){
    $.ajax({
        method:"GET",
        url:"index_pdo.php",
        data:{"action":"retweet"},
        success:function(r){}
    });
});

$(document).on("click","#favori", function(){
    $.ajax({
        method:"GET",
        url:"index_pdo.php",
        data:{"action":"favori"},
        success:function(r){}
    });
});