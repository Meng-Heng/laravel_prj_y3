@extends('layout.backend')
@section('content')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Add a Brand</h1>
        <!-- <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{url('/user')}}">Go back</a></li>
        </ol> -->
        <div class="card mb-4">
            <div class="card-body">
                @if(Session::has('brand_create'))
                <div class="alert alert-primary alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Primary!</strong> {!! session('brand_create') !!}
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
                {!! Form::open(array('url'=>'brand', 'files'=>'true')) !!}
               
                {!! Form::label('brandName', 'Brand Name:') !!}
                {!! Form::text('brandName',null, array('class'=>'form-control')) !!}

                {!! Form::label('description', 'Description:') !!}
                {!! Form::textarea('description',null, array('class'=>'form-control')) !!}
                <br>
                
                {!! Form::submit('Enter', array('class'=>'btn btn-primary')) !!}

                <a class="btn btn-primary" href="{!! url('/brand')!!}">Back</a>

                {!! Form::close() !!}
                
            </div>
        </div>
</main>
@endsection
