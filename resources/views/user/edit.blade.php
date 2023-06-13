@if(Auth::user()->id == $user->id )
@extends('layouts.app')
@section('content')





<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit user</div>

                <div class="card-body">
                    <form method="POST" action="/user/{{$user->id}}">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value=" {{$user->name}}  " required>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{$user->email}}" required>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">sex </label>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" value="male" type="radio" name="sex" id="gender1"
                                        @if($user->sex
                                    == 'male')
                                    checked
                                    @endif>
                                    <label class="form-check-label" for="gender1">
                                        male
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" value="female" type="radio" name="sex" id="gender2"
                                        @if($user->sex
                                    == 'female')

                                    checked
                                    @endif>
                                    <label class="form-check-label" for="gender2">
                                        female
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">blood type </label>
                            <div class="col-md-6">
                                <select class="form-select" name="blood_type" aria-label="Default select example">
                                    <option value="A" @if($user->blood_type === 'A')
                                        selected @endif>type: A</option>
                                    <option value="B" @if($user->blood_type === 'B')
                                        selected @endif>type: B</option>
                                    <option value="AB" @if($user->blood_type === 'AB')
                                        selected @endif>type: AB</option>
                                    <option value="O" @if($user->blood_type === 'O')
                                        selected @endif >type: O</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input type="hidden" name="old_password" value="{{ $user->password }}"> <input
                                    id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    autocomplete="new-password"
                                    placeholder="Leave it empty if you don't want to change it">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="retype_password"
                                    autocomplete="new-password"
                                    placeholder="Leave it empty if you don't want to change it">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
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
@else
@section('content')
@php
echo "<div class='alert alert-danger text-center'>you cant access on this id</div>";
header("Refresh=3;url=/");
@endphp
@endsection
@endif