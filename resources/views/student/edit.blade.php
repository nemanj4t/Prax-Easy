@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Izmeni - student') }}</div>

                    <div class="card-body">
                        <form enctype="multipart/form-data" method="POST" action="{{ route('student.update') }}">
                            @csrf
                            <div class="form-group row">
                                <div class="col- text-center">
                                    <img src="/storage/uploads/avatars/{{$user->avatar}}" style="width:150px; height:150px; border-radius:50%;" alt="" class="my-4">
                                    <input type="file" name="avatar">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('Ime') }}</label>

                                <div class="col-md-6">
                                    <input id="first_name" class="form-control" value="{{$user->student->first_name}}" name="first_name" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Prezime') }}</label>

                                <div class="col-md-6">
                                    <input id="last_name" class="form-control" value="{{$user->student->last_name}}" name="last_name" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="student_number" class="col-md-4 col-form-label text-md-right">{{ __('Broj indeksa') }}</label>

                                <div class="col-md-6">
                                    <input id="student_number" class="form-control" value="{{$user->student->student_number}}" name="student_number" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="faculty_id" class="col-md-4 col-form-label text-md-right">{{ __('Fakultet') }}</label>

                                <div class="col-md-6">
                                    <select id="faculty_id" class="form-control" name="faculty_id" required>
                                        @foreach($faculties as $faculty)
                                            <option value={{$faculty->id}}>{{$faculty->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-cyan">
                                        {{ __('Izmeni') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection