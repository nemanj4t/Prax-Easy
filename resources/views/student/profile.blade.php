@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12" >
                <div class="panel-body">
                    <div class="row">
                        <div class=" col-md-6 col-lg-6">
                            <img src="/storage/uploads/avatars/{{$user->avatar}}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right: 25px" alt="">
                            <br>
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
                                @auth
                                    @if($user->id === auth()->user()->id)
                                        <tr>
                                            <td><a href="/student/edit" class="btn btn-secondary">Izmeni</a></td>
                                            <td></td>
                                        </tr>
                                    @endif
                                @endauth
                                </tbody>
                            </table>
                        </div>
                        <div style="padding:0;" class="card col-md-6">
                            <div class="card-body">
                                <h4>Preporuke</h4>
                                @foreach ($recommendations as $recommendation)
                                    <div class="alert alert-info"><a href="/company/profile/{{$recommendation->company['user_id']}}">{{$recommendation->company['name']}}</a> je preporučio studenta
                                        {{$user->student->first_name}} {{$user->student->last_name}}
                                    </div>
                                @endforeach
                                @auth
                                    @if(auth()->user()->type === 'company')
                                        @if(auth()->user()->company->checkIfStudentBelongsToCompanyInternship($user->student))
                                            @if(auth()->user()->company->checkIfCompanyBelongsToStudentRecommendations($user->student))
                                                <button type="button" disabled>Preporuka</button>
                                            @else
                                                <form action="{{route('recommendation.store')}}" method="post">
                                                    <input type="hidden" name="student_id" value="{{$user->student->id}}">
                                                    <input type="hidden" name="company_id" value="{{auth()->user()->company->id}}">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn-primary">Preporuka</button>
                                                </form>
                                            @endif
                                        @endif
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection