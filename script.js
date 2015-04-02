//Quand on va cliquer sur le bouton de connexion
$(document).on("click","#co",function(){
    var tata = $("#valueCo").val();
    $.ajax({
        method:"POST",
        url:"index_pdo.php",
        data:{"action":"co",
            "login":tata,
            "javascript":"oui" 
        },
        success:function(r){
            console.log(eval(r));
        }
    });
});

//Quand on va cliquer sur le bouton de déconnexion
$(document).on("click", "#deco", function(){
    $.ajax({
        method: "POST",
        url: "index_pdo.php",
        data:{"action":"deco",
              "javascript":"non"
            },
        success : function(r){}
    });
});

$(document).on("click","#retweet", function(){
    var tata = 
    $.ajax({
        method:"GET",
        url:"index_pdo.php",
        data:{"action":"retweet",
            "idTwit":tata
        },
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


