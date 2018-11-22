@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Kompanija</h1>
                <a href="/internship" class="btn btn-primary">Nova praksa</a>
                <a href="/company/application" class="btn btn-primary">Menadzer</a>
                <hr>
                @foreach($internships as $internship)
                    <div >
                        <div class="card my-3 d-flex">
                            <div class="row card-body">
                                <div class="col-md-9">
                                    <a href="/internship/{{$internship->id}}"><h2>{{$internship->title}}</h2></a>
                                    <p>by {{$internship->company->name}}</p>
                                    @foreach($internship->tags as $tag)
                                        <a href="/internship/tags/{{$tag->name}}"><span class="badge badge-secondary">{{$tag->name}}</span></a>
                                    @endforeach
                                </div>
                                <div class="col-md-3">
                                    @if($internship->isActive())
                                        AKTIVNO
                                    @else
                                        NEAKTIVNO
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection