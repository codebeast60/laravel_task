@if(Auth::user()->groupID == 1 )
@extends('layouts.app')
@section('content')

@if(session()->has('error'))
<div class="container">

    <div class="alert alert-danger text-dark muted text-center fw-bold w-75 m-auto">
        {{ session()->get('error')}}
    </div>
</div>
@endif
@if(session()->has('message'))
<div class="alert alert-success text-center" role="alert">
    {{session()->get('message')}}
</div>
@endif
<h1 class="text-center">hello admin <span class="text-primary fw-bold"> {{Auth::user()->name}}</span></h1>


<div class="container mt-5">
    <h1 class="text-center mb-4 text-uppercase fw-bold">users</h1>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#id</th>
                <th scope="col">name</th>
                <th scope="col">last login</th>
                <th scope="col">edit user </th>
                <th scope="col">user status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            @php
            $dateString = $user->updated_at;
            $timestamp = strtotime($dateString);
            $modifiedTimestamp = strtotime('+3 hours', $timestamp);
            $modifiedDate = date('Y-m-d H:i:s', $modifiedTimestamp);
            @endphp
            <tr>
                <th scope="row">{{$user->id}}</th>
                <td>{{$user->name}}</td>
                <td> {{ $modifiedDate }}</td>
                <td>
                    <a href="/admin/{{$user->id}}/edit" class="btn btn-success">edit</a>
                </td>
                <td>
                    @if( $user->approved == 0)

                    <form action="{{ route('user.update-status', $user->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-warning " type="submit">not active</button>
                    </form>
                    @elseif( $user->approved == 1)

                    <form action="{{ route('user.update-status', $user->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-info" type="submit">activated</button>
                    </form>
                    @endif
                </td>
            </tr>

        </tbody>
        @endforeach
    </table>


</div>


<hr>


<div class="container mt-3 mb-3 p-4">
    <div class="row">

        <h1 class="text-center mb-4 text-uppercase fw-bold">certeficates</h1>


        @foreach($certeficates as $certeficate)
        <div class="col-md-4 mb-3">
            <div class="card" style="width: 20rem;height:25rem;background-color:#ffcf52">

                <div class="card-body">
                    <h5 class="card-title text-center fw-bold"> {{$certeficate->name}} </h5>
                    <hr>
                    <p class="card-text font-monospace">{{$certeficate->description}}</p>
                </div>
                <div class="m-3">
                    <form method="POST" action="/admin/{{$certeficate->id}}">
                        @csrf
                        @method('delete')
                        <button type="submit"
                            class="rounded fw-bold text-light p-2 text-decoration-none bg-danger border-0 ">
                            Delete
                        </button>
                    </form>

                </div>
            </div>
        </div>
        @endforeach
    </div>
    <a href="/admin/create" class="btn btn-success mt-5">+ add certeficate</a>
</div>
<hr>

<div class="container mt-2 mb-5">

    <h1 class="text-center mb-4 text-uppercase fw-bold">certeficates per user</h1>

    <table class="table" class="table table-dark table-hover">
        <thead>
            <tr>
                <th scope="col">#id</th>
                <th scope="col">certificate name</th>
                <th scope="col">users</th>
            </tr>
        </thead>
        <tbody>
            @foreach($certeficates as $certificate)
            <tr>
                <th scope="row">{{ $certificate->id }}</th>
                <td>{{$certificate->name}}</td>
                <td>
                    @foreach ($counts as $item)
                    @if( $item->c_id === $certificate->id)
                    {{ $item->count}}
                    @endif
                    @endforeach
                </td>
            </tr>
            @endforeach


        </tbody>
    </table>
</div>


@endsection
@else
@php
echo "<div class='alert alert-danger text-center'>only admins can see the content of this page</div>";
header("Refresh=3;url=/");
@endphp

@endif