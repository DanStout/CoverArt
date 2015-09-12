<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>CoverArt</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
@include('partials.nav')
<div class="container">
    @yield('content')
</div>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
@yield('scripts')
</body>
</html>
