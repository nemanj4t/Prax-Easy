@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
                <div class="panel-body">
                    <div class="row">
                        <div class=" col-md-9 col-lg-9 ">
                            <img src="/storage/uploads/avatars/{{$user->avatar}}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right: 25px" alt="">
                            <table class="table table-user-information">
                                <tbody>
                                <tr>
                                    <td>Ime:</td>
                                    <td>{{$user->company->name}}</td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td><a href="mailto:{{$user->email}}">{{$user->email}}</a></td>
                                </tr>
                                <tr>
                                    <td>Adresa:</td>
                                    <td>{{$user->company->address}}</td>
                                </tr>
                                <tr>
                                    <td>Kontakt telefon:</td>
                                    <td>{{$user->company->phone_number}}</td>
                                </tr>
                                @auth
                                    @if($user->id === auth()->user()->id)
                                        <tr>
                                            <td><a href="/company/edit" class="btn btn-secondary">Izmeni</a></td>
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
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>Comments</h3>
                        </div><!-- /col-sm-12 -->
                    </div><!-- /row -->
                    @foreach ($comments as $comment)
                    <div class="row">
                        <div class="col-sm-1">
                            <div class="thumbnail">
                                <img src="/storage/uploads/avatars/{{$comment->user->avatar}}" style="width:32px; height:32px; border-radius:50%; position:absolute; top:10px; left:10px;" alt="">
                            </div><!-- /thumbnail -->
                        </div><!-- /col-sm-1 -->
                        <div class="col-sm-11">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a href="mailto:{{$user->email}}"><strong>{{$comment->user->email}}</strong></a>
                                    <span class="text-muted"> commented {{$comment->created_at}}</span>
                                </div>
                                <div class="panel-body">
                                    {{$comment->content}}
                                </div><!-- /panel-body -->
                            </div><!-- /panel panel-default -->
                        </div><!-- /col-sm-5 -->
                    </div>
                    @endforeach
                    <hr>
                    @auth
                    <form action="{{ route('comment.store') }}" method="POST">
                        <textarea class="col-md-12" placeholder="Ostavite komentar" name="comment"></textarea>
                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                        <input type="hidden" name="company_id" value="{{$user->company->id}}">
                        <button type="submit" class="btn-primary">Post</button>
                        @csrf
                    </form>
                    @endauth
                </div>
            </div>
        </div>
        <h1>O Nama</h1>

        <hr>
        <p style="font-size: 20px;">{{$user->company->description}}</p>
    </div>
@endsection

