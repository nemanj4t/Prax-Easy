@extends('layouts.app')

@section('content')
    <div class="container">
        @auth
            @if ($user == auth()->user())
                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header"><h3>Prihvaćene aplikacije</h3></div>
                        <div class="card-body">
                            <table class="col-md-12 col-lg-12">
                                @foreach ($applicationsAccepted as $application)
                                    <tr>
                                        <td><a href="/internship/{{$application->internship_id}}">{{$application->internship->title}}</a></td>
                                        <td>{{$application->created_at}}</td>
                                        <td>
                                            <form method="POST" action="{{ route('student.assignInternship') }}">
                                                @csrf
                                                <input type="hidden" id="application_id" name="application_id" value={{$application->id}}>
                                                @if (!$application->internship->vecUpisana($application->student))
                                                    <button type="submit" class="btn btn-success">
                                                        {{ __('upiši') }}
                                                    </button>
                                                @else
                                                    <button class="btn btn-secondary" disabled>
                                                        {{ __('upisano') }}
                                                    </button>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header"><h3>Moje aplikacije</h3></div>
                        <div class="card-body">
                            <table class="col-md-12 col-lg-12">
                                @foreach ($applications as $application)
                                    <tr>
                                        <td><a href="/internship/{{$application->internship_id}}">{{$application->internship->title}}</a></td>
                                        <td>{{$application->created_at}}</td>
                                        <td><a href="#" data-toggle="modal" data-target="#myModal{{$application->id}}" class="btn btn-primary">pregledaj</a></td>
                                    </tr>
                                    <div class="modal fade" id="myModal{{$application->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">{{$application->student->first_name." ".$application->student->last_name}}
                                                    </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>{{$application->description}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        @endauth
    </div>
@endsection