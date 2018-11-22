@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($internships as $internship)
            @if (!$internship->applications->isEmpty())
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">

                            <div class="card-header col-md-12"><h3><a href="/internship/{{$internship->id}}">{{$internship->title}}</a></h3></div>
                            <div class="card-body">
                                <table class="col-md-12 col-lg-12">
                                    @foreach ($internship->applications as $application)
                                            <tr>
                                                <td>
                                                    <a href="/student/profile/{{$application->student->user_id}}">
                                                    {{$application->student->first_name." ".$application->student->last_name}}
                                                    </a>
                                                </td>
                                                <td><a href="#" data-toggle="modal" data-target="#myModal{{$application->id}}" class="btn btn-primary">pregledaj</a></td>

                                                    <td>
                                                        <form method="POST" action="{{ route('company.acceptApplication') }}">
                                                            @csrf
                                                            <input type="hidden" id="application_id" name="application_id" value={{$application->id}}>
                                                            @if(!$application->accepted)
                                                                <button type="submit" class="btn btn-success">
                                                                    {{ __('Prihvati') }}
                                                                </button>
                                                            @else
                                                                <button class="btn btn-blue-grey" disabled>Prihvaćeno</button>
                                                            @endif
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <form method="POST" action="{{ route('company.declineApplication') }}">
                                                            @csrf
                                                            <input type="hidden" id="application_id" name="application_id" value={{$application->id}}>
                                                            @if(!$application->accepted)
                                                                <button type="submit" class="btn btn-danger">
                                                                    {{ __('Obriši') }}
                                                                </button>
                                                            @endif
                                                        </form>
                                                    </td>

                                            </tr>

                                        <div class="modal fade" id="myModal{{$application->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">{{$application->student->first_name." ".$application->student->last_name}}</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>{{$application->description}}</p>
                                                        <a href="/storage/uploads/cvs/{{$application->cv}}" download>download cv</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                </table>
                            </div>
                            <hr>
                            <div class="card-body">
                                <h3>Upisani: </h3>
                                <ui>
                                    @foreach($internship->students as $student)
                                        <li><a href="/student/profile/{{$student->user_id}}">{{$student->first_name." ".$student->last_name}}</a></li>
                                    @endforeach
                                </ui>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            @endif
        @endforeach
    </div>
@endsection