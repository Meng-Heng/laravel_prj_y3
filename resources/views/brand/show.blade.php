@extends('layout.backend')
@section('content')
<main>
	<div class="container-fluid">
		<h1>Brand Information</h1>
		<div class="card">
            <div class="card-body">
                <p>ID: {{$brand->id}} </p>
                <p>Brand Name: {{$brand->brandName}}</p>
                <p>Description: {{$brand->description}}</p>
            </div>
		</div>
        <br>
        <a class="btn btn-primary" href="{{url('/brand')}}">Back</a>
	</div>
</main>
@endsection