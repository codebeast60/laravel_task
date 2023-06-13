@if(Auth::user()->groupID == 1 )
@extends('layouts.app')
@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">add certeficate</div>

                <div class="card-body">
                    <form method="POST" action="/admin">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" required>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="textarea" class="col-md-4 col-form-label text-md-end">Description</label>

                            <div class="col-md-6">

                                <textarea class="form-control" name="description" id="textarea" rows="6"></textarea>
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    add certeficate
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
@php
echo "<div class='alert alert-danger text-center'>only admins can see the content of this page</div>";
header("Refresh=3;url=/");
@endphp

@endif