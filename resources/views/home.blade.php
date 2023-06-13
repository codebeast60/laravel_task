@if($user->groupID === 1 || $user->approved === 1)

@extends('layouts.app')

@section('content')
@if(session()->has('message'))
<div class="alert alert-success text-center" role="alert">
    {{session()->get('message')}}
</div>
@endif


@php
$user_c = [];
foreach($user_certificates as $c){
array_push($user_c,$c->c_id);
}

@endphp

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{-- {{ __('You are logged in!') }} --}}
                    <table>
                        <tr>
                            <td class="p-1">Name: </td>
                            <td class="p-1">{{$user->name}}</td>
                        </tr>
                        <tr>
                            <td class="p-1">email: </td>
                            <td class="p-1">{{$user->email}}</td>
                        </tr>
                        <tr>
                            <td class="p-1">gender : </td>
                            <td class="p-1">{{$user->sex}}</td>
                        </tr>
                        <tr>
                            <td class="p-1">blood type : </td>
                            <td class="p-1">{{$user->blood_type}}</td>
                        </tr>

                        <tr>
                            <td class="pt-3"><a href="/user/{{$user->id}}/edit" class="btn btn-success ">edit
                                    profile</a></td>

                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@if($user->groupID === 0)
<div class="container mt-3">
    <div class="row">

        <h1 class="text-center mb-4 text-uppercase fw-bold">my certeficates</h1>




        @foreach($certificates as $certificate)



        @if(in_array($certificate->id,$user_c))
        <div class="col-md-4">
            <div class="card m-2" style="width: 18rem;height:25rem;background-color:#ffcf52">

                <div class="card-body">
                    <h5 class="card-title text-center fw-bold"> {{$certificate->name}} </h5>
                    <hr>
                    <p class="card-text font-monospace">{{$certificate->description}}</p>


                </div>
                <div class="m-3">

                    <form method="POST" action="/user/{{$certificate->id}}">
                        @csrf
                        @method('delete')
                        <button type="submit"
                            class="rounded fw-bold text-light p-2 text-decoration-none bg-danger border-0 ">Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>

        @endif
        @endforeach




    </div>





    <a href="/user" class="btn btn-success ms-4 mt-3">add certeficates</a>
    {{-- @else
    <div class="container">
        <a href="/admin" class="btn btn-success ms-4">dashboard</a> --}}
    @endif
</div>
</div>

@endsection

@else
@section('content')
@php
echo "<div class='alert alert-danger text-center'>your account needs to activate by admin please be patient<br>we will
    activate your account soon</div>";
header("Refresh=3;url=/");
@endphp
@endsection
@endif