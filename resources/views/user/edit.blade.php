@extends('layout.backend')
@section('content')
<main>
	<div class="container-fluid">
		<h1 class="mt-4">Edit User information</h1>
		<!-- <ol class="breadcrumb mb-4">
			<li class="breadcrumb-item"><a href="/user">View all product</a></li>
			<li class="breadcrumb-item active"><a href="product/create">Create post</a></li>
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
                
                {!! Form::model($user , array('route' => array('user.update', $user->id), 'method'=>'PUT','files'=>'true')) !!}
                {!! Form::open(array('url'=>'user', 'files'=>'true')) !!}
               
                                    {!! Form::label('username', 'Username:') !!}
                                        {!! Form::text('username',null, array('class'=>'form-control')) !!}

                                        {!! Form::label('email', 'Email:') !!}
                                        {!! Form::text('email',null, array('class'=>'form-control')) !!}

                                        {!! Form::label('role', 'Role:') !!}
                                        {!! Form::text('role',null, array('class'=>'form-control')) !!}

                                        {!! Form::label('active', 'Active or not?:') !!}
                                        {!! Form::text('active',null, array('class'=>'form-control')) !!}
               
               <br>
               {!! Form::submit('Update', array('class'=>'btn btn-primary')) !!}

               <a class="btn btn-primary" href="{!! url('/user')!!}">Back</a>
                {!! Form::close() !!}
			</div>
		</div>
	</div>
</main>
@endsection