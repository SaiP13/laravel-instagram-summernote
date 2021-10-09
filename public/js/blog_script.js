
$(document).ready(function(){

    get_blogs();

    function get_blogs(){
        $.ajax({
            url: config.routes.base+"/getAjaxBlogs",
            type: "get",
            success: function(res){
                $('.blogs_result').html(res);
            }

        });
    }
    $('.add_like').on('click', function(){
        var id = $(this).data('id');

        $.ajax({
            url: config.routes.base+"/addLike",
            type: "get",
            data: { 'id': id },

            success: function(res){
                if(res == "success"){

                    alert('success');
                    get_blogs();

                } else {
                    alert("Failed");
                    get_blogs();

                }
            }

        });

    });

    $('.remove_like').on('click', function(){
        var id = $(this).data('id');

        $.ajax({
            url: config.routes.base+"/removeLike",
            type: "get",
            data: { 'id': id },

            success: function(res){
                if(res == "success"){

                    alert('success');
                    get_blogs();

                } else {
                    alert("Failed");
                    get_blogs();

                }
            }

        });

    });

});




