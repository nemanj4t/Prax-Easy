@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>{{$internship->title}}</h1>
                @foreach($internship->tags as $tag)
                    <a href="/internship/tags/{{$tag->name}}" class="badge badge-info">{{$tag->name}}</a>
                @endforeach
                <hr>
                <p>{{$internship->description}}</p>

                <ui>
                    <li>Mesta: {{$internship->current_number}}/{{$internship->maximum_number}}</li>
                    <li>Radno vreme: {{$internship->work_hours}}</li>
                    <li>Adresa: {{$internship->address}}</li>
                </ui>
                @auth
                    <a href="{{ url()->previous() }}" class="btn btn-cyan">Nazad</a>
                    @if(auth()->user()->type == 'student' && $internship->nijeAplicirano(auth()->user()->student) && $internship->isActive() && $internship->imaMesta())
                        <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-cyan">Apliciraj</a>
                    @endif
                    @if(auth()->user()->id == $internship->company->user_id)
                        <a href="/internship/{{$internship->id}}/edit" class="btn btn-primary">Izmeni</a>
                        @if(!$internship->isActive())
                            <a href="/internship/{{$internship->id}}/re" class="btn btn-warning">Obnovi</a>
                        @endif
                    @endif
                @endauth
            </div>
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">{{$internship->title}}</h4>
                        </div>
                        <div class="modal-body">
                            <form method="POST" enctype="multipart/form-data" action="{{ route('student.application') }}">
                                <input type="hidden" id="internship_id" name="internship_id" value={{$internship->id}}>
                                @csrf
                                <div class="form-group row">
                                    <div class="col-md-9">
                                        <textarea id="description" class="form-control" placeholder="Poruka" name="description" required></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-9">
                                        <input id="cv" class="form-control" name="cv" type="file" required>
                                    </div>
                                </div>
                                <label>Okači svoj CV</label>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Apliciraj') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection