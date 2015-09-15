<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>CoverArt</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
@include('partials.nav')
<div class="container content">
    @include('partials.sesmsg')
    @yield('content')
</div>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
@yield('scripts')
</body>
</html>
