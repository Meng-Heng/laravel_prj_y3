@extends('layout.backend')
@section('content')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Add a Product</h1>
        <!-- <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{url('/user')}}">Go back</a></li>
        </ol> -->
        <div class="card mb-4">
            <div class="card-body">
                @if(Session::has('product_create'))
                <div class="alert alert-primary alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Success!!</strong> {!! session('product_create') !!}
                </div>
                @endif
                @if (count($errors) > 0)
                <!-- Form Error List -->
                <div class="alert alert-danger">
                    <strong>Something is Wrong</strong>
                    <br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <!-- It Create the new User -->
                <br>
                {!! Form::open(array('url'=>'product', 'files'=>'true')) !!}
               
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name',null, array('class'=>'form-control')) !!}

                {!! Form::label('material', 'Material:') !!}
                {!! Form::text('material',null, array('class'=>'form-control')) !!}

                {!! Form::label('color', 'Color:') !!}
                {!! Form::text('color',null, array('class'=>'form-control')) !!}

                {!! Form::label('price', 'Price:') !!}
                {!! Form::text('price',null, array('class'=>'form-control')) !!}

                {!! Form::label('image', 'Image:') !!}
                {!! Form::file('image', array('class'=>'form-control')) !!}

                {!! Form::label('brand_id', 'Brand:') !!}
                {!! Form::select('brand_id',$brands ,null ,array('class'=>'form-select')) !!}
                <br>
                
                {!! Form::submit('Enter', array('class'=>'btn btn-primary')) !!}

                <a class="btn btn-primary" href="{!! url('/product')!!}">Back</a>

                {!! Form::close() !!}
                
            </div>
        </div>
</main>
@endsection
