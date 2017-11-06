function sendPost()
{
    var token = $("input[name=_token]").val();
    var body = $("#body").val();

    $.ajax({
        type: "POST",
        url: "/news",
        data: {
            _token:token,
            body:body
        },
        cache:false,
        success: function (data){
            $("#post_status").text(data).show();
            $("#post-form")[0].reset();
            $("#post_status").text(data).fadeOut('slow');
        },
        error: function (){
            alert("fail to send post");
        }
    });
    return false;
}
    
var feedPosts = function (){
    $.get('/load-posts', function (data){
        $(".posts-info").html("");
        $.each(data, function (index, value){
            $(".posts-info").append(`
                <p>`+ value.username +`</p>
                <p>`+ value.body +`</p>
                <p>`+ value.date +`</p>
            `);
        });
    });
};

$(document).ready(function (){
     $.get('/load-posts', function (data){
        $(".posts-info").html("");
        $.each(data, function (index, value){
            $(".posts-info").append(`
                <p><i class="fa fa-user"></i> `+ value.username +`</p>
                <p>`+ value.body +`</p>
                <p class="small">`+ value.date +`</p>
                <hr />
            `);
        });
    });
});