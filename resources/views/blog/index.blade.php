<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blogs</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" >
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        body {
            background: #eee
        }

        .date {
            font-size: 11px
        }


        .comment-text {
            font-size: 12px
        }

        .fs-12 {
            font-size: 12px
        }

        .shadow-none {
            box-shadow: none
        }

        .name {
            color: #007bff
        }

        .cursor:hover {
            color: blue
        }

        .cursor {
            cursor: pointer
        }

        .textarea {
            resize: none
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-light bg-light">
        <span class="navbar-brand mb-0 h1"><a href="{{ url('/')}}">Home</a> | Blogs</span>
        @if(session('adminid'))
            <span class="navbar-brand mb-0 h1" style="float: right">{{ ucfirst(session('adminname')) }}</span>
        @endif

    </nav>


    <div class="blogs_result"></div>

    {{-- @foreach($blogs as $blog)
        <div class="container mt-5">
            <div class="d-flex justify-content-center row">
                <div class="col-md-6">
                    <div class="d-flex flex-column comment-section">

                        <div class="bg-white p-2">
                            <div class="d-flex flex-row user-info"><img class="rounded-circle" src="{{ url('users/',$blog->profile_img)}}" width="40">
                                <div class="d-flex flex-column justify-content-start ml-2">
                                    <span class="d-block font-weight-bold name">{{ $blog->name }}</span>
                                    <span class="date text-black-50">{{ date("d M Y", strtotime($blog->created_at)) }} </span></div>
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

                        <div class="bg-white">
                            <div class="d-flex flex-row fs-12">

                                @if(Helper::checkLike($blog->blog_id))
                                    <a class="like p-2 cursor remove_like" id="remove_like" data-id="{{ $blog->blog_id }}" style="color:red">
                                        <i class="fa fa-thumbs-o-up" ></i><span class="ml-1">Liked ( <span id="like_count">{{ Helper::likes_count($blog->blog_id) }} </span>)</span>
                                    </a>
                                @else
                                    <a class="like p-2 cursor add_like" id="add_like" data-id="{{ $blog->blog_id }}">
                                        <i class="fa fa-thumbs-o-up"></i><span class="ml-1">Like (<span id="like_count">{{ Helper::likes_count($blog->blog_id) }} </span>)</span>
                                    </a>
                                @endif


                                <buuton id="comments" data-id="{{ $blog->blog_id }}" class="like p-2 cursor comments" >

                                    <i class="fa fa-commenting-o"></i>
                                    <span class="ml-1">Comments (<span id="comment_count">{{ Helper::comments_count($blog->blog_id) }} </span>) </span>
                                </buuton>

                                <div class="like p-2 cursor"><i class="fa fa-share"></i><span class="ml-1">Share</span></div>
                            </div>
                        </div>

                        <div class="commentSection" id="commentSection" style="display: none">
                            <div class="bg-light p-2">
                                <div class="d-flex flex-row align-items-start"><img class="rounded-circle" src="https://i.imgur.com/RpzrMR2.jpg" width="40">
                                    <textarea name="comment" id="comment" class="form-control ml-1 shadow-none textarea"></textarea>
                                </div>
                                <div class="mt-2 text-right">
                                    <button class="btn btn-primary btn-sm shadow-none save_comment" id="save_comment" data-id="{{ $blog->blog_id }}" type="button">Post comment</button>
                                </div>
                            </div>

                            <div class="display_comments"> </div>

                        </div>



                    </div>
                </div>
            </div>
        </div>
    @endforeach --}}



</body>
<script>
    // global app configuration object
    var config = {

        blogs: function(){
            $.ajax({
                url: "{{ url('getAjaxBlogs')}}",
                type: "get",

                success: function(res){
                    $('.blogs_result').html(res);
                }

            });
        }
    };
</script>

<script>

    $(document).ready(function(){
        config.blogs();
    });

</script>
</html>
