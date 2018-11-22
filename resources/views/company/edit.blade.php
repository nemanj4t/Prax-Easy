 @extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Izmeni - kopmpanija') }}</div>

                    <div class="card-body">
                        <form enctype="multipart/form-data" method="POST" action="{{ route('company.update') }}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <img src="/storage/uploads/avatars/{{$user->avatar}}" style="width:150px; height:150px; border-radius:50%; margin-right: 25px" alt="">
                                    <input type="file" name="avatar">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Naziv kompanije') }}</label>

                                <div class="col-md-6">
                                    <input id="name" class="form-control" value="{{$user->company->name}}" name="name" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Broj telefona') }}</label>

                                <div class="col-md-6">
                                    <input id="phone_number" class="form-control" value="{{$user->company->phone_number}}" name="phone_number" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Adresa') }}</label>

                                <div class="col-md-6">
                                    <input id="address" class="form-control" value="{{$user->company->address}}" name="address" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('O nama') }}</label>

                                <div class="col-md-6">
                                    <textarea id="address" class="form-control" name="description" required>{{$user->company->description}}</textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
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