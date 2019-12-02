

$( document ).ready(function() {
    $(".hide-tweet").click(function(){
        var myJsonData = {tweet: $(this).data("tweet"),idUser:$(this).data("iduser")};
        
        if($("#"+$(this).attr("for")).prop("checked"))
        {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:'/showtweets',
                data:myJsonData,
                type:'POST',
                success:  function (response) {
                    if(response>0)
                        $("#"+$(this).attr("for")).attr("checked",false);
                }
            });
        }
        else{
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:'/hidetweets',
                data:myJsonData,
                type:'POST',
                success:  function (response) {
                    if(response>0)
                        $("#"+$(this).attr("for")).attr("checked",true);
                }
            });
        }        
    });
});