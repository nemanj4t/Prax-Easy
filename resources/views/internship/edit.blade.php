@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Izmenite praksu') }}</div>

                    <div class="card-body col-md-12">
                        <form method="POST" action="{{ route('internship.update') }}">
                            @csrf
                            <input type="hidden" value="{{$internship->id}}" name="id">
                            <div class="form-group row">
                                <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('Naslov') }}</label>

                                <div class="col-md-4">
                                    <input id="title" class="form-control" value="{{$internship->title}}" name="title" required>
                                </div>

                                <label for="duration" class="col-md-2 col-form-label text-md-right">{{ __('Dužina trajanja prakse') }}</label>

                                <div class="col-md-4">
                                    <input id="duration" class="form-control" value="{{$internship->duration}}" type="number" min="1" name="duration" required>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="maximum_number" class="col-md-2 col-form-label text-md-right">{{ __('Mesta') }}</label>

                                <div class="col-md-4">
                                    <input id="maximum_number" class="form-control" value="{{$internship->maximum_number}}" type="number" min="1" name="maximum_number" required>
                                </div>

                                <label for="work_hours" class="col-md-2 col-form-label text-md-right">{{ __('Radno vreme') }}</label>

                                <div class="col-md-4">
                                    <input id="work_hours" class="form-control" value="{{$internship->work_hours}}" name="work_hours" required>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="end" class="col-md-2 col-form-label text-md-right">{{ __('Rok za prijavu') }}</label>

                                <div class="col-md-4">
                                    <input id="end" class="form-control" value="{{$internship->date}}" type="date" name="end" required>
                                </div>

                                <label for="address" class="col-md-2 col-form-label text-md-right">{{ __('Adresa') }}</label>

                                <div class="col-md-4">
                                    <input id="address" class="form-control" value="{{$internship->address}}" name="address" required>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('Opis prakse') }}</label>

                                <div class="col-md-10">
                                    <textarea id="description" style="height:300px" class="form-control" name="description" required>{{$internship->description}}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="duration" class="col-md-2 col-form-label text-md-right">{{ __('Dodavanje tagova') }}</label>

                                <div class="row col-md-10">
                                    @foreach(App\Tag::all() as $tag)
                                        <div class="col-md-2">
                                            <input type="checkbox" name="check_list[]" value="{{$tag->id}}"> {{$tag->name}}
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-2">
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