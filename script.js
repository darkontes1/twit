
$("form").attr("action","#");

//Quand on va cliquer sur le bouton de connexion
$("#co").on("click",function(){
    $.ajax({
        type:"POST"

    });
}

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