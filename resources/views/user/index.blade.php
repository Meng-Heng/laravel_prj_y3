@extends('layout.backend')
@section('content')
                @if(Session::has('user_create'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Primary!</strong> {!! session('user_create') !!}
                </div>
                @endif
                @if(Session::has('user_update'))
                <div class="alert alert-primary alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Success!</strong> {!! session('user_update') !!}
                </div>
                @endif
                @if(Session::has('user_deleted'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Deleted!</strong> {!! session('user_deleted') !!}
                </div>
                @endif

                <nav class="navbar navbar-expand navbar-white bg-gray">
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{ route('users.search') }}" method="GET">
            <div class="input-group" name="search">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." name="query" >
                <div class="input-group-append">
                    <button class="btn btn-danger" type="submit" name="search">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
                <div class="ml-2">
                    <a class="btn btn-primary" href="{!! url('/user')!!}">Refresh</a>
                </div>
            </div>
        </form>
</nav>
        <div class="table-responsive">
            <div class="my-2">
                <a class="btn btn-primary" href="{{url('/user/create')}}" data-bs-toggle="modal" data-bs-target="#exampleModal">Create</a>
            </div>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Active</th>
                        <th>Created_Date</th>
                        <th>Updated_Date</th>
                        <th colspan=2>Operation</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Active</th>
                        <th>Created_Date</th>
                        <th>Updated_Date</th>
                        <th colspan=2>Operation</th>
                    </tr>
                </tfoot>
                <tbody>
                @foreach ($user as $users)
                    <tr>
                        <td>
                        <div><a href="{{url('/user/'.$users->id)}}">{{ $users->username }}</a></div>
                        </td>
                        <td>
                            <div>{!! $users->email !!}</div>
                        </td>
                        <td>
                            <div>{!! $users->role !!}</div>
                        </td>
                        <td>
                            <div>{!! $users->active !!}</div>
                        </td>
                        <td>
                            <div>{!! $users->created_at !!}</div>
                        </td>
                        <td>
                            <div>{!! $users->updated_at !!}</div>
                        </td>
                        <td><a class="btn btn-primary" href="{{url('user/'.$users->id.'/edit')}}">Edit</a></td>
                        <td>
                            
                                        {!! Form::open(array('url'=>'user/'. $users->id, 'method'=>'DELETE')) !!}
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button class="btn btn-danger delete">Delete</button>
                                        {!! Form::close() !!}
                                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
           
            <!-- Insert Modal -->
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add a User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
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
                                    </div>
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                {!! Form::submit('Insert', array('class'=>'btn btn-primary')) !!}
                                {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Modal -->

        </div>
    </div>
    </div>
</div>
@endsection
