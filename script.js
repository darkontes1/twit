//Quand on va cliquer sur le bouton de connexion
$(document).on("click","#co",function(){
    var valueCo = $("#valueCo").val();
    $.ajax({
        method:"POST",
        url:"index_pdo.php",
        data:{"action":"co",
            "login":valueCo,
            "javascript":"oui" 
        },
        success:function(r){
            //console.log(eval(r));
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

$(document).on("click","#a_retweet", function(){
    var idTwit = $("#a_retweet").attr("data-value").value;
    alert(idTwit);
    $.ajax({
        method:"GET",
        url:"index_pdo.php",
        data:{"action":"retweet",
            "idTwit":idTwit
        },
        success:function(r){}
    });
});

$(document).on("click","#a_favori", function(){
    var idTwit = $("#a_favori").attr("data-value").value;
    $.ajax({
        method:"GET",
        url:"index_pdo.php",
        data:{"action":"favori",
            "idTwit":idTwit
        },
        success:function(r){}
    });
});


