<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Eshop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/styl.css') }}" type="text/css">
</head>
<body class="container-fluid">
<header class="navbar navbar-dark bg-secondary">
    <a href="{{ url('/') }}"><img class="navbar-brand" alt="logo" id="logo" src="{{ asset('img/logo-ricom-energy.png') }}"></a>
    <div id="login-formular" class="mt-md-0" >
        @auth
            @component("auth.logout_button")
            @endcomponent
        @endauth
        @guest
            @component("auth.login_button")
            @endcomponent
        @endguest
    </div>
</header>
<div class="sticky-top">
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse" id="navbarCollapse">
        @component("components.categories")
        @endcomponent
    </div>
    <a class="btn btn-outline-light" href="{{ url('cart') }}" role="button" >Košík({{ $numberInCart }})</a>
</nav>
    @yield("filter")
</div>
    @yield("content")
</body>
</html>
