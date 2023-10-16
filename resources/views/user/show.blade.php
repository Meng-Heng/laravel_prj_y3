@extends('layout.backend')
@section('content')
<main>
	<div class="container-fluid">
		<h1>User Information</h1>
		<div class="card">
            <div class="card-body">
                <p>ID: {{$user->id}} </p>
                <p>Username: {{$user->username}}</p>
                <p>Email: {{$user->email}}</p>
                <p>Role: {{$user->role}}</p>
                <p>Active State: {{$user->active}}</p>
            </div>
		</div>
        <br>
        <a class="btn btn-primary" href="{{url('/user')}}">Back</a>
	</div>
</main>
@endsection