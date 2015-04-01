$("body").find("#container").children("form").attr("action","#");
alert("toto");
//Quand on va cliquer sur le bouton de connexion
$("#myform").on("click",function(){
    alert("toto");
    var tata = $("#valueCo").val();
    $.ajax({
        method:$(this).attr("method"),
        url:$(this).attr("action"),
        data:{"action":"co",
            $(this).serialize()
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

<<<<<<< HEAD
$("#deco").on("click", function()
{
    $.ajax({
                method: "POST",
                url: "traitement.php",
                data: {code:code_image},
                success : function() 
                    {
                        // var canvas = document.createElement("canvas");
                        // $("canvas").attr("width",$("img").width) ;
                        // $("canvas").attr("height", $("img").height)                       

                    }
            });
    });
=======
//
>>>>>>> origin/master
