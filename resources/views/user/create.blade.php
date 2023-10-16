@extends('layout.backend')
@section('content')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Add a User</h1>
        <!-- <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{url('/user')}}">Go back</a></li>
        </ol> -->
        <div class="card mb-4">
            <div class="card-body">
                
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
                {!! Form::open(array('url'=>'user', 'files'=>'true')) !!}
               
                {!! Form::label('username', 'Username:') !!}
                {!! Form::text('username',null, array('class'=>'form-control')) !!}

                {!! Form::label('email', 'Email:') !!}
                {!! Form::text('email',null, array('class'=>'form-control')) !!}

                {!! Form::label('password', 'Password:') !!}
                {!! Form::text('password',null, array('class'=>'form-control')) !!}

                {!! Form::label('role', 'Role:') !!}
                {!! Form::text('role',null, array('class'=>'form-control')) !!}

                {!! Form::label('active', 'Active?:') !!}
                {!! Form::text('active',null, array('class'=>'form-control')) !!}
                <br>
                
                {!! Form::submit('Enter', array('class'=>'btn btn-primary')) !!}

                <a class="btn btn-primary" href="{!! url('/user')!!}">Back</a>

                {!! Form::close() !!}
                
            </div>
        </div>
</main>
@endsection