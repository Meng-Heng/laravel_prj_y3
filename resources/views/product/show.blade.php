@extends('layout.backend')
@section('content')
<main>
	<div class="container-fluid">
		<h1>Watch Information</h1>
		<div class="card">
            <div class="card-body">
                <p>ID: {{$product->id}} </p>
                <p>Name: {{$product->name}}</p>
                <p>Material: {{$product->material}}</p>
                <p>Color: {{$product->color}} </p>
                <p>Price: {{$product->price}}</p>
                <p>Brand: {{$product->brand->brandName}}</p>
                <div>{!! Html::image('/img/'.$product->image, $product->name, array('width'=>'300')) !!}</div>
            </div>
		</div>
        <br>
        <a class="btn btn-primary" href="{{url('/product')}}">Back</a>
	</div>
</main>
@endsection