@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Edit Entry') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('update_entries') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
                                <input type="hidden" id="idEntry" name="idEntry" value="{{$entry->id}}">
                                <input type="hidden" id="idUser" name="idUser" value="{{$entry->idUser}}">
                                @error('idEntry')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @error('idUser')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{$entry->title}}" required autocomplete="title" autofocus>
    
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>
                                <div class="col-md-6">
                                    <textarea name="content" class="form-control rounded-0 @error('content') is-invalid @enderror" id="content" rows="3">
                                        {{$entry->content}}
                                    </textarea>
                                    @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                            @if (session('updated'))
                                <br>
                                <div class="alert alert-success mt-3">
                                    {{session('updated')}}
                                </div>
                            @elseif (session('warning'))
                                <br>
                                <div class="alert alert-warning mt-3">
                                    {{session('warning')}}
                                </div>
                            @elseif (session('error'))
                                <br>
                                <div class="alert alert-error mt-3">
                                    {{session('error')}}
                                </div>
                            @endif
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
