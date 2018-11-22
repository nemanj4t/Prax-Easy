@extends('layouts.adminLayout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12" >
                <div class="panel-body">
                    <div class="row">
                        <div class=" col-md-6 col-lg-6">
                            <img src="/storage/uploads/avatars/{{$user->avatar}}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right: 25px" alt="">
                            <table class="table table-user-information">
                                <tbody>
                                <tr>
                                    <td>Ime:</td>
                                    <td>{{$user->student->first_name}}</td>
                                </tr>
                                <tr>
                                    <td>Prezime:</td>
                                    <td>{{$user->student->last_name}}</td>
                                </tr>
                                <tr>
                                    <td>Fakultet:</td>
                                    <td>{{$user->student->faculty->name}}</td>
                                </tr>
                                <tr>
                                    <td>Indeks:</td>
                                    <td>{{$user->student->student_number}}</td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td><a href="mailto:{{$user->email}}">{{$user->email}}</a></td>
                                </tr>
                                @if($user->id === auth()->user()->id)
                                    <tr>
                                        <td><a href="/student/edit" class="btn btn-secondary">Izmeni</a></td>
                                        <td></td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        @if ($user == auth()->user())
                            <div class="col-md-6 col-lg-6">
                                <div class="card">

                                    <div class="card-header"><h3>Prihvacene aplikacije</h3></div>
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
                                                                    {{ __('upisi') }}
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
                                                                <h4 class="modal-title" id="myModalLabel">{{$application->student->first_name." ".$application->student->last_name}}</h4>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection