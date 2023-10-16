@extends('layout.backend')
@section('content')

        <div class="table-responsive">
                <a class="btn btn-primary" href="{{url('/user/create')}}">Create</a>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Active</th>
                        <th>Created_Date</th>
                        <th>Updated_Date</th>
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
                    </tr>
                </tfoot>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>
                            <div class=""><a href="{{url('/user/'.$user->id)}}">{{ $users->username }}</a></div>
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
                        <td><a class="btn btn-primary" href="{!! url('user/' . $user->id . '/edit') !!}">Edit</a></td>

                                    <td>
                                        {!! Form::open(array('url'=>'user/'. $user->id, 'method'=>'DELETE')) !!}
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button class="btn btn-danger delete">Delete</button>
                                        {!! Form::close() !!}
                                    </td>
                    </tr>
                    @endfoeach
                    
                </tbody>
            </table>
        </div>

        <div class="table-responsive">
                <a class="btn btn-primary" href="{{url('/brand/create')}}">Create</a>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Brand Name</th>
                        <th>Description</th>
                        <th>Created_Date</th>
                        <th>Updated_Date</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Brand Name</th>
                        <th>Description</th>
                        <th>Created_Date</th>
                        <th>Updated_Date</th>
                    </tr>
                </tfoot>
                <tbody>
                @foreach ($brand as $brands)
                    <tr>
                        <td>
                            <div class=""><a href="{{url('/brand/'.$brands->id)}}">{{ $brands->brandName }}</a></div>
                        </td>
                        <td>
                            <div>{!! $brands->description !!}</div>
                        </td>
                        </td>
                        <td>
                            <div>{!! $brands->created_at !!}</div>
                        </td>
                        <td>
                            <div>{!! $brands->updated_at !!}</div>
                        </td>
                        <td><a class="btn btn-primary" href="{!! url('brand/' . $brands->id . '/edit') !!}">Edit</a></td>

                                    <td>
                                        {!! Form::open(array('url'=>'brand/'. $brands->id, 'method'=>'DELETE')) !!}
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button class="btn btn-danger delete">Delete</button>
                                        {!! Form::close() !!}
                                    </td>
                    </tr>
                    @endfoeach
                    
                </tbody>
            </table>
        </div>
    @endsection
