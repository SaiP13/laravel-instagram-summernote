
@extends('home.includes.app')

@section('content')

    @include('home.includes.header')

    <div id="summernote">{!! $result->home !!}</div>

    <button class="btn btn-primary" id="submit">Update</button>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
      <script>

        $('#submit').on('click',function(){

          var value = $('#summernote').summernote('code');

          $.post('{{ url("update-home-content")}}',{content:value,"_token": "{{ csrf_token() }}"},function(respo){
            if(respo == "success"){
                      alert("Successfully Updated!");
                  } else {
                      alert('Failed ! Try again..');
                  }
          })


        });


      </script>
@include('home.includes.footer')

@endsection




