<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>
    <!-- Bootstrap core CSS -->
    <link href="/frontend/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/frontend/css/modern-business.css" rel="stylesheet">
</head>

<body>

<nav class="navbar fixed-top navbar-expand-lg navbar-light fixed-top bg-light">
    <div class="container">
    <a class="navbar-brand" href="{{route('enguncelhaber.index')}}">En Güncel Haber</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php
            $data = \App\Models\Categories::all();
            ?>
            @foreach($data as $veriler)
                <li class="nav-item">
                    <a class="nav-link" href="@if (strlen($veriler->url)>0) {{route($veriler->url.'.index')}} @else javascript:void(0) @endif">{{$veriler->description}}</a>
                </li>
            @endforeach
        </ul>
    </div>
    </div>
</nav>

@yield('content')


<!-- Footer -->
<footer class="py-5 bg-light">
    <div class="container">
        <?php
            $now = \Illuminate\Support\Carbon::now();
        ?>
        Tüm Hakları Saklıdır. {{$now->year}}
        <p class="m-0 text-center text-white"></p>
    </div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="/frontend/vendor/jquery/jquery.min.js"></script>
<script src="/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/js/custom.js"></script>

</body>

</html>
