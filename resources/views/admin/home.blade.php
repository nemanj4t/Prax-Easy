@extends('layouts.adminLayout')

@section('content')
    <div class="container">

        <div class="row justify-content-center">

            <div class="card col-md-2" style="height:200px">
                <div class="card-body">
                    <ui>
                        <li><a href="?type=faculty">Fakulteti</a></li>
                        <li><a href="?type=company">Kompanije</a></li>
                        <li><a href="?type=student">Studenti</a></li>
                    </ui>
                </div>
            </div>
            <div class="card col-md-8 offset-md-1">
                <div class="card-body">
                    <table class="col-md-12 table">
                        <tr>
                            <th>E-mail</th>
                            <th>Kreiran</th>
                            <th>Izmenjen</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->email}}</td>
                                <td>{{$user->created_at}}</td>
                                <td>{{$user->updated_at}}</td>
                                <td><a href="#" data-toggle="modal" data-target="#myModal{{$user->id}}" class="btn btn-primary">Pregledaj</a></td>
                                <td>
                                    <form method="POST" action="{{ route('admin.destroy') }}">
                                        @csrf
                                        {{method_field('DELETE')}}
                                        <input type="hidden" value="{{$user->id}}" name="id">
                                        <button type="submit" class="btn btn-danger">
                                            {{ __('Obriši') }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <div class="modal fade" id="myModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                @if($user->type == 'student')
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">{{$user->student->first_name." ".$user->student->last_name}}</h4>
                                            </div>
                                            <div class="row col-md-12 modal-body">
                                                <img class="col-md-4" src="/storage/uploads/avatars/{{$user->avatar}}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right: 25px" alt="">
                                                <div class="col-md-7">
                                                    <p><strong>Indeks:</strong> {{$user->student->student_number}}</p>
                                                    <p><strong>Fakultet:</strong> {{$user->student->faculty->name}}</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <a href="/admin/student/{{$user->id}}" class="btn btn-primary">Profil</a>
                                        </div>
                                    </div>
                                @endif

                                @if($user->type == 'faculty')
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">{{$user->faculty->name}}</h4>
                                            </div>
                                            <div class="row col-md-12 modal-body">
                                                <img class="col-md-4" src="/storage/uploads/avatars/{{$user->avatar}}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right: 25px" alt="">
                                                <div class="col-md-7">
                                                    <p><strong>Adresa:</strong> {{$user->faculty->address}}</p>
                                                    <p><strong>Telefon:</strong> {{$user->faculty->phone_number}}</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <a href="/admin/faculty/{{$user->id}}" class="btn btn-primary">Profil</a>
                                        </div>
                                    </div>
                                @endif

                                @if($user->type == 'company')
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">{{$user->company->name}}</h4>
                                            </div>
                                            <div class="row col-md-12 modal-body">
                                                <img class="col-md-4" src="/storage/uploads/avatars/{{$user->avatar}}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right: 25px" alt="">
                                                <div class="col-md-7">
                                                    <p><strong>Adresa:</strong> {{$user->company->address}}</p>
                                                    <p><strong>Telefon:</strong> {{$user->company->phone_number}}</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <a href="/admin/company/{{$user->id}}" class="btn btn-primary">Profil</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </table>
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection