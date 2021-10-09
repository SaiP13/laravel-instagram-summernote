
@foreach($comments as $comment)
<div class="bg-light p-2">
    <div class="d-flex flex-row align-items-start">
        <img class="rounded-circle" src="{{ url('users/',$comment->profile_img)}}" width="40">&nbsp;&nbsp;
        <div class="">

            <span class="comment-text" style="color:black">
                <b>{{ ucfirst($comment->name) }}</b>
                |{{ \Carbon\Carbon::parse($comment->datetime)->diffForHumans() }}</span>
                @if(session('adminname') == $comment->name)
                    |<a class="edit-comment" data-id="{{ $comment->id }}"> <i class="fa fa-edit"></i></a>
                    |<a class="delete-comment" data-id="{{ $comment->id }}" ><i class="fa fa-trash"></i> </a>
                @endif
                <br>

                <span class="comment-text old-comment-{{ $comment->id }}"> {{ ucfirst($comment->comment) }}</span>

                <div class="update-section-{{ $comment->id }}" style="display: none">
                    <input name="comment-value" type="text" id="comment-value-{{ $comment->id }}" value="{{$comment->comment }}" />
                    <button class="btn btn-success btn-sm submit-comment-{{ $comment->id }}" id="">update</button>
                    <button class="btn btn-danger btn-sm cancel-{{ $comment->id }}" id="cancel">cancel</button>
                </div>
        </div>

    </div>


</div>
@endforeach

<script>

    $(".delete-comment").click(function(){
        var id = $(this).data('id');
        if(confirm('Are you sure to delete')) {
            $.ajax({
                url: "{{ url('deleteComment')}}",
                type: "get",
                data: { "id":id },
                success: function(data){
                    alert('Successfully deleted!');
                    config.blogs();
                }
            });
        }
    });

    $('.edit-comment').on('click', function () {
        var id = $(this).attr('data-id');

        $('.old-comment-'+id).hide();
        $('.update-section-'+id).show();

        $('.submit-comment-'+id).click(function(){

            var comment = $('#comment-value-'+id).val();
            $.ajax({
                url: "{{ url('updateComment')}}",
                type: "get",
                data: { "id": id, "comment": comment },
                success: function(data){
                    //alert('Successfully Updated!');
                    config.blogs();
                    $('.old-comment[data-id='+id+']').show();
                    $('.update-section[data-id='+id+']').hide();
                }
            });

        });
        $('.cancel-'+id).click(function(){

            $('.old-comment-'+id).show();
            $('.update-section-'+id).hide();
        });
    });

</script>
