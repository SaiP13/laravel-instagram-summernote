@foreach($blogs as $blog)
        <div class="container mt-5">
            <div class="d-flex justify-content-center row">
                <div class="col-md-6">
                    <div class="d-flex flex-column comment-section">

                        <div class="bg-white p-2">
                            <div class="d-flex flex-row user-info"><img class="rounded-circle" src="{{ url('users/',$blog->profile_img)}}" width="40">
                                <div class="d-flex flex-column justify-content-start ml-2">
                                    <span class="d-block font-weight-bold name">{{ $blog->name }}</span>
                                    <span class="date text-black-50">{{ \Carbon\Carbon::parse($blog->created_at)->diffForHumans() }} </span></div>
                            </div>
                            <hr>
                            <div class="p-2">
                                <p class="text">{{ $blog->blog_title }}</p>
                            </div>

                            <div class="p-2">
                                <img src="{{ url('blogs/',$blog->blog_img)}}" class="img-thumbnail" height="400" width="350">
                            </div>
                            <div class="p-2">
                                Description : <p class="comment-text">{{ $blog->description }}</p>
                            </div>
                        </div>

                        <div class="bg-white" style="font-weight: bold  ">
                            <div class="d-flex flex-row fs-12">
                                <!-- like -->
                                @if(Helper::checkLike($blog->blog_id))
                                    <a class="like p-2 cursor remove_like" id="remove_like" data-id="{{ $blog->blog_id }}" style="color:red">
                                        <i class="fa fa-thumbs-o-up" ></i><span class="ml-1">Liked ( <span id="like_count">{{ Helper::likes_count($blog->blog_id) }} </span>)</span>
                                    </a>
                                @else
                                    <a class="like p-2 cursor add_like" id="add_like" data-id="{{ $blog->blog_id }}">
                                        <i class="fa fa-thumbs-o-up"></i><span class="ml-1">Likes (<span id="like_count">{{ Helper::likes_count($blog->blog_id) }} </span>)</span>
                                    </a>
                                @endif

                                <!-- dislike -->
                                @if(Helper::checkDislike($blog->blog_id))
                                    <a class="like p-2 cursor remove_dislike" id="remove_dislike" data-id="{{ $blog->blog_id }}" style="color:red">
                                        <i class="fa fa-thumbs-o-down" ></i><span class="ml-1">Disliked ( <span id="like_count">{{ Helper::dislikes_count($blog->blog_id) }} </span>)</span>
                                    </a>
                                @else
                                    <a class="like p-2 cursor add_dislike" id="add_dislike" data-id="{{ $blog->blog_id }}">
                                        <i class="fa fa-thumbs-o-down"></i><span class="ml-1">Dislikes (<span id="like_count">{{ Helper::dislikes_count($blog->blog_id) }} </span>)</span>
                                    </a>
                                @endif


                                <a id="comments" data-id="{{ $blog->blog_id }}" class="like p-2 cursor comments" >

                                    <i class="fa fa-commenting-o"></i>
                                    <span class="ml-1">Comments (<span id="comment_count">{{ Helper::comments_count($blog->blog_id) }} </span>) </span>
                                </a>

                                {{-- <div class="like p-2 cursor"><i class="fa fa-share"></i><span class="ml-1">Share</span></div> --}}
                            </div>
                        </div>

                        <div class="commentSection-{{ $blog->blog_id }}" id="commentSection" style="display: none">
                            <div class="bg-light p-2">
                                {{-- <div class="d-flex flex-row align-items-start"><img class="rounded-circle" src="{{ url('users/',$blog->profile_img)}}" width="40"> --}}

                                    <div class="d-flex flex-row align-items-start"><img class="rounded-circle" src="{{ url('users/',session('profile_img'))}}" width="40">


                                    <textarea name="comment" id="comment" class="form-control ml-1 shadow-none textarea-{{ $blog->blog_id }}"></textarea>
                                </div>
                                <div class="mt-2 text-right">
                                    <button class="btn btn-primary btn-sm shadow-none save_comment-{{ $blog->blog_id }}" id="save_comment" type="button">Post comment</button>
                                </div>
                            </div>

                            <div class="display_comments-{{ $blog->blog_id }}"> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script>

        $(".comments").on("click", function(){

            var id = $(this).data('id');

            $('.commentSection-'+id).toggle();
            comments(id);

            $('.save_comment-'+id).on('click', function(){

                var comment = $('.textarea-'+id).val();
                if(comment != ""){
                    $.ajax({
                        url: "{{ url('saveComment')}}",
                        type: "get",
                        data: { 'id': id, 'comment':comment },

                        success: function(res){
                            if(res == "success"){
                                comments(id);
                                config.blogs();

                            } else {
                                comments(id);
                                config.blogs();
                            }
                        }

                    });
                } else {
                    alert('Please enter your comment');
                }
            });


        });

        function comments(id){

            $.ajax({
                url: "{{ url('getComments')}}",
                type: "get",
                data: { 'id': id },

                success: function(data){
                    $(".display_comments-"+id).html(data);
                }

            });
        }

        $('.add_like').on('click', function(){
            var id = $(this).data('id');

            $.ajax({
                url: "{{ url('addLike')}}",
                type: "get",
                data: { 'id': id },

                success: function(res){
                    if(res == "success"){
                        config.blogs();
                    } else {
                        config.blogs();
                    }
                }
            });
        });

        $('.remove_like').on('click', function(){
            var id = $(this).data('id');

            $.ajax({
                url: "{{ url('removeLike')}}",
                type: "get",
                data: { 'id': id },

                success: function(res){
                    if(res == "success"){
                        config.blogs();
                    } else {
                        config.blogs();
                    }
                }

            });

        });

        $('.add_dislike').on('click', function(){
            var id = $(this).data('id');

            $.ajax({
                url: "{{ url('addDislike')}}",
                type: "get",
                data: { 'id': id },

                success: function(res){
                    if(res == "success"){
                        config.blogs();
                    } else {
                        config.blogs();
                    }
                }
            });
        });

        $('.remove_dislike').on('click', function(){
            var id = $(this).data('id');

            $.ajax({
                url: "{{ url('removeDislike')}}",
                type: "get",
                data: { 'id': id },

                success: function(res){
                    if(res == "success"){
                        config.blogs();
                    } else {
                        config.blogs();
                    }
                }

            });

        });

    </script>
