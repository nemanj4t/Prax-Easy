@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
                <div class="panel-body">
                    <div class="row">
                        <div class=" col-md-12 col-lg-12 ">
                            <table class="table table-user-information">
                                <img src="/storage/uploads/avatars/{{$user->avatar}}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right: 25px" alt="">
                                <tbody>
                                    <tr>
                                        <td>Ime:</td>
                                        <td>{{$user->faculty->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Email:</td>
                                        <td><a href="mailto:{{$user->email}}">{{$user->email}}</a></td>
                                    </tr>
                                    <tr>
                                        <td>Adresa:</td>
                                        <td>{{$user->faculty->address}}</td>
                                    </tr>
                                    <tr>
                                        <td>Kontakt telefon:</td>
                                        <td>{{$user->faculty->phone_number}}</td>
                                    </tr>
                                @auth
                                    @if($user->id === auth()->user()->id)
                                        <tr>
                                            <td><a href="/faculty/edit" class="btn btn-secondary">Izmeni</a></td>
                                            <td></td>
                                        </tr>
                                    @endif
                                @endauth
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-md-6 col-lg-6 ">
                <h1>O Nama</h1>

                <hr>
                <p style="font-size: 20px;">{{$user->faculty->description}}</p>
            </div>
        </div>
    </div>
@endsection