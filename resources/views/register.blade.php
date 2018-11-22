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
        <title>PraxEasy</title>
        <link href="{{'css/reg.css'}}" rel="stylesheet"/>
    </head>
<body>
    <div class="container">
        
                <div class=" d-flex justify-content-center align-items-center" id="logInForm">
                        <div class="col-lg-6 card text-center card-form" id="logInCard">
                            <ul class="nav nav-tabs">
                                    <li class="active">
                                            <i class="fas fa-user-graduate fa-sm"></i>
                                        <a data-toggle="tab" href="#studentReg">Student</a></li>
                                    <li>
                                            <i class="fas fa-suitcase fa-sm"></i>
                                        <a data-toggle="tab" href="#companyReg">Kompanija</a></li>
                                    
                            </ul>
                            <div class="tab-content">
                                <div id="studentReg" class="tab-pane active">
                                        <div class="card-body">
                                                <h4>Registruj se</h4>
                                                <hr>
                                                <form method="POST" action="{{ route('student.registration') }}">
                                                    @csrf
                                                    <div class="input-group my-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-user fa-sm"></i></span>     
                                                            </div>

                                                        <input id="first_name" class="form-control" name="first_name" placeholder="Ime" required>
                                                        
                                                    </div>
                                                    <div class="input-group my-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-user fa-sm"></i></span>     
                                                        </div>

                                                        <input id="last_name" class="form-control" name="last_name" placeholder="Prezime" required>
                                                    
                                                </div>
                                                <div class="input-group my-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-id-card-alt fa-sm"></i></span>     
                                                    </div>

                                                    <input id="student_number" class="form-control" name="student_number" placeholder="Broj Indeksa" required>
                                                  </div>

                                                  <div class="input-group my-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-at fa-sm"></i></span>     
                                                    </div>

                                                      <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="E-mail" required>

                                                      @if ($errors->has('email'))
                                                          <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                          </span>
                                                      @endif
                                                  </div>

                                            <div class="input-group my-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-university fa-sm"></i></span>     
                                                </div>

                                                <select id="faculty_id" class="form-control" name="faculty_id" required>
                                                    @foreach($faculties as $faculty)
                                                        <option value={{$faculty->id}}>{{$faculty->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        
                                                    <div class="input-group my-3">
                                                            <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-lock fa-sm"></i></span>     
                                                                </div>
                                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="password" required>

                                                        @if ($errors->has('password'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('password') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>

                                                    <div class="input-group my-3">
                                                        <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-lock fa-sm"></i></span>     
                                                            </div>
                                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Ponovite password" required>
                                                        </div>

                                                    <input type="submit" class="btn btn-color">
                                                    
                                                    
                                                    
                                                </form>
                                            </div>
                                </div>
                                <div id="companyReg" class="tab-pane fade">
                                        <div class="card-body">
                                                <h4>Registruj kompaniju</h4>
                                                <hr>
                                            <form method="POST" action="{{ route('company.registration') }}">
                                                @csrf
                                                    <div class="input-group my-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-at fa-sm"></i></span>     
                                                            </div>

                                                        <input id="email" placeholder="E-mail" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                                        @if ($errors->has('email'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div class="input-group my-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-building fa-sm"></i></span>     
                                                        </div>

                                                        <input id="name" placeholder="Ime kompanije" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" required>
                                                    
                                                    </div>

                                                    <div class="input-group my-3">
                                                            <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-lock fa-sm"></i></span>     
                                                                </div>
                                                        <input id="password" placeholder="Password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                                        @if ($errors->has('password'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('password') }}</strong>
                                                            </span>
                                                        @endif                                                    </div>
                                                    <div class="input-group my-3">
                                                        <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-lock fa-sm"></i></span>     
                                                            </div>
                                                        <input id="password-confirm" placeholder="Ponovite password" type="password" class="form-control" name="password_confirmation" required>
                                                    </div>
                                                    
                                                    <input type="submit" class="btn btn-color">
                                                    
                                                    
                                                    
                                                </form>
                                            </div>
                                </div>
                                    
                            </div>
                            
                        </div>      
                    </div>
        <p class="text-center my-4" style="color:white;">Prax Easy - Lako do prakse</p>
        
            
    </div>
        
    







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