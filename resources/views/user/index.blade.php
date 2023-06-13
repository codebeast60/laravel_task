@extends('layouts.app')
@section('content')

@if(session()->has('error'))
<div class="container">

    <div class="alert alert-danger text-dark muted text-center fw-bold w-75 m-auto">
        {{ session()->get('error')}}
    </div>
</div>
@endif

@php
$user_c =[];

foreach($user_certificates as $c){
array_push($user_c,$c->c_id);
}
@endphp


<form method="POST" action="{{ route('user.store') }}">
    @csrf
    <div class="container">


        <div class="row">

            @foreach ($certeficates as $card)
            @if(!in_array($card->id,$user_c))


            <div class="col-md-4 pt-2">
                <div class="card" style="width: 20rem;height:25rem;background-color:#ffcf52">
                    <div class="card-body">
                        <h5 class="card-title text-center fw-bold">{{$card->name}}</h5>
                        <hr>
                        <p class="card-text  font-monospace">{{$card->description}}</p>
                        <label for="check" class="p-2 fw-bold"> check </label>
                        <input type="checkbox" name="selected_cards[]" value="{{ $card->id }}">
                    </div>
                </div>
            </div>
            @endif
            @endforeach

        </div>
        <button class="btn btn-success mt-4" type="submit">Save</button>
    </div>
</form>

@endsection