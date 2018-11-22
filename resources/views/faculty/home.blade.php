@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">

            <div class="card col-md-2" style="height:200px">
                <div class="card-header">Generacije</div>
                <div class="card-body">
                    @foreach($years as $year)
                        <a href="?year={{$year->school_year}}">{{$year->school_year}}</a>
                    @endforeach
                </div>
            </div>
            <div class="card col-md-8 offset-md-1">
                <div class="card-body">
                    <table class="col-md-12 table">
                        <tr>
                            <th>Ime i Prezime</th>
                            <th>Indeks</th>
                            <th>Prakse</th>
                            <th>Godina</th>
                        </tr>
                        @foreach ($students as $student)
                            <tr>
                                <td><a href="/student/profile/{{$student->user_id}}">{{$student->first_name." ".$student->last_name}}</a></td>
                                <td>{{$student->student_number}}</td>
                                <td>
                                    <ui>
                                        @foreach($student->internships as $internship)
                                            <li><a href="/internship/{{$internship->id}}">{{$internship->title}}</a></li>
                                        @endforeach
                                    </ui>
                                </td>
                                <td>{{$student->school_year}}</td>
                            </tr>
                        @endforeach
                    </table>
                    {{$students->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection