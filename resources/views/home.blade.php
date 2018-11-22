@extends('layouts.app')
@section('content')

    <div class="container">
        <h1 class="display-5 text-center my-4" style="margin-bottom:10rem;">Pretrazi otvorena mesta za praksu</h1>
        <form action="/search" method="GET" role="search" style="margin-top:5rem;">
            @csrf
            <div class="row">
                <div class="col-sm-3 col-sm-offset-3">
                    <div id="imaginary_container">
                        <div class="input-group stylish-input-group">
                            <input type="text" class="form-control"  placeholder="Search" name='search'>
                            <span class="input-group-addon">
                                <a type="submit">
                                    <span class="form-group"></span>
                                </a >
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <br>
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>
        <br>
        <div class="row align-items-start ">
            @foreach($internships as $internship)
                <div class="col-md-6">
                    <div class="card my-3 d-flex">
                        <div class="card-body">
                            <img src="/storage/uploads/avatars/{{App\User::find($internship->company->user_id)->avatar}}" class="card-img-top float-left" style="height:3rem;width:3rem; border-radius:50%;">
                            <a href="/internship/{{$internship->id}}"><h2 class="mx-4" style="margin-bottom:2rem;padding-left:2rem;">{{$internship->title}}</h2></a>
                            <hr>
                            <p class=" my-4"><a href="/company/profile/{{$internship->company->user_id}}">by {{$internship->company->name}}</a></p>
                            @foreach($internship->tags as $tag)
                                <a href="/internship/tags/{{$tag->name}}"><span class="badge badge-info">{{$tag->name}}</span></a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

