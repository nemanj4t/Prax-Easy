<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.4/css/mdb.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">
    <title>Portal PraxEasy - Lako do prakse</title>
    <link href="{{'css/style.css'}}" rel="stylesheet"/>
</head>
<body id="home">
    <!--NAV SECTION-->
    
        <nav class="navbar navbar-expand-sm navbar-dark fixed-top">
            <div class="container">
                <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a href="/" class="navbar-brand">PraxEasy</a>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a href="/home" class="nav-link">Home</a>
                        </li>
                        @auth
                            <li class="nav-item"><a class="nav-link" href="{{ route(auth()->user()->type.'.home') }}">{{ __('Dashboard') }}</a></li>
                        @endauth
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        @guest
                            <li class="nav-item">
                                <a href="#hiring-section" class="nav-link">Hiring Now</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="nav-link">{{ __('Sign Up') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link">{{ __('Log In') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="position:relative; padding-left:50px;">
                                    <img src="/storage/uploads/avatars/{{auth()->user()->avatar}}" style="width:32px; height:32px; border-radius:50%; position:absolute; top:10px; left:10px;" alt="">
                                    {{ Auth::user()->email }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route(auth()->user()->type.'.profile') }}">Profil</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>    
        </nav>

    @guest
    <!--HOME SECTION-->
    <header id="home-section">
        <div class="dark-overlay">
            <div class="home-inner">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-lg-8 d-none d-lg-block">
                            
                            <h1 class="display-3">Dodji lako do željene prakse</h1>
                            <h3 class="my-2">Apliciraj na jednu od mnogobrojnih praksi iz tvoje struke</h3>
                        </div>

                        <div class="col-lg-4" id="logInForm">
                            <div class="card bg-primary text-center card-form">
                                <div class="card-body">
                                    <h3 class="my-4">Prijavi se</h3>
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="input-group my-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-user fa-sm"></i></span>
                                                </div>

                                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="E-mail" value="{{ old('email') }}" required autofocus>
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif

                                        </div>
                                        <div class="input-group my-4">
                                                <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-lock fa-sm"></i></span>
                                                    </div>
                                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <input type="submit" class="btn btn-color">
                                        <hr>
                                        <div class="text-right d-flex flex-column">
                                                <label>Niste clan? <a href="/register">Registrujte se</a></label>
                                                <label>Zaboravili ste <a href="{{ route('password.request') }}">Password?</a></label>
                                        </div>

                                    </form>
                                </div>
                            </div>      
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
    @endguest
    <!--HIRING SECTION-->
    <section id="hiring-section" class="py-4">
        <div class="container">
                <h1 class="text-center">Companies that want you working for them right now</h1>
                <p class="text-center my-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, nobis.</p>
            <div class="row">
                @foreach($users as $user)
                    <div class="col-md-3 my-4">
                        <div class="card">
                            <div class="card-body">
                                <img class="card-img-top" src="/storage/uploads/avatars/{{$user->avatar}}" style="width:100%;">
                                <h4 class="text-center my-2">{{$user->company->name}}</h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </section>

    <!--FOOTER-->
    <footer>
        <div class="container">
            <h3 class="text-center">what</h3>
            <p class="text-center">Professional procrastinators 2018</p>
        </div>
x`x    </footer>




    



 
    
 <!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.13.0/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.4/js/mdb.min.js"></script>   
</body>
</html>