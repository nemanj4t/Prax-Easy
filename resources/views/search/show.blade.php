@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="/search" method="GET" role="search">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <div id="imaginary_container">
                            <div class="input-group stylish-input-group">
                                <input type="text" class="form-control"  placeholder="Search" name='search'>
                                <span class="input-group-addon">
                                <a type="submit">
                                    <span class="form-group"></span>
                                </a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <br>
        <div class="justify-content-center">
            <div class="row col-md-12">
                @if(count($internships) == 0 && count($students) == 0 && count($companies))
                    <div> Search not found! </div>
                @endif
                @foreach($internships as $internship)
                    <div class="col-md-6">
                        <div class="card my-3 d-flex">
                            <div class="card-body">
                                <a href="/internship/{{$internship->id}}"><h2>{{$internship->title}}</h2></a>
                                <p><a href="/company/profile/{{$internship->company->user_id}}">by {{$internship->company->name}}</a></p>
                                @foreach($internship->tags as $tag)
                                    <a href="/internship/tags/{{$tag->name}}"><span class="badge badge-secondary">{{$tag->name}}</span></a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
                @foreach($students as $student)
                    <div class="col-md-6">
                        <div class="card my-3 d-flex">
                            <div class="card-body">
                                <a href="/student/profile/{{$student->user_id}}"><h2>{{$student->first_name}} {{$student->last_name}}</h2></a>
                                <p>{{$student->faculty->name}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                @foreach($companies as $company)
                    <div class="col-md-6">
                        <div class="card my-3 d-flex">
                            <div class="card-body">
                                <a href="/company/profile/{{$company->user_id}}"><h2>{{$company->name}}</h2></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection