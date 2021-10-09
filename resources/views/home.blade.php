<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

    <nav class="navbar navbar-light bg-light">
        <span class="navbar-brand mb-0 h1">Home</span>
    </nav>
    <div class="container">

        <div class="row">

            <div class="col-2"><a class="btn btn-success" href="{{ url('/home') }}" >Website</a> </div>
            <div class="col-2"><a class="btn btn-success" href="{{ url('/blog') }}"> Blogs</a></div>
            <div class="col-2"><a class="btn btn-success" href="{{ url('/admin') }}">Admin</a> </div>
            <div class="col-2"><a class="btn btn-success" href="{{ url('/locality') }}">Locality</a> </div>
            <div class="col-2"><a class="btn btn-success" href="{{ url('/student') }}">Students</a> </div>

        </div>

    </div>
</body>
</html>
