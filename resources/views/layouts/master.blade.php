<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" …>
    <title>Szablon Bootstrap w Laravel</title><!-- Bootstrap CSS -->
    <link href="http://localhost:8000/css/styles.css" rel="stylesheet">
</head>
<body>
{{-- W tym miejscu szablon menu --}}
@include('layouts.nav')
<main role="main" class="container">
    <div class="row">
        <div class="col-sm-8 blog-main">
            {{-- Tu pojawi się zawartość bloku o nazwie 'content' --}}@yield('content')
        </div>
        @include('layouts.aside')
    </div>
</main> <!-- /.container -->
@include('layouts.footer')
</body>
</html>
