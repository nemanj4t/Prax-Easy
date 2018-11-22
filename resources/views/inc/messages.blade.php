@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger" >
            {{$error}}
        </div>
    @endforeach
@endif

@if(session('success'))
    <div onclick="jQuery($('#message').fadeOut(2000))" id="message" style="position: absolute; bottom: 50px; right: 50px; z-index: 10; font-size: 250%;" class="alert alert-success">
        {{session('success')}}
    </div>
@endif

@if(session('error'))
    <div onclick="jQuery($('#message').fadeOut(2000))" id="message" style="position: absolute; bottom: 50px; right: 50px; z-index: 10; font-size: 250%;" class="alert alert-danger">
        {{session('error')}}
    </div>
@endif

