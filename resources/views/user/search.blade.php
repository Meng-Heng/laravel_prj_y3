@extends('layout.backend')
@section('content')

@if (count($users) > 0)
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
<div class="panel panel-default">

    <div class="panel-body">
        <table class="table table-bordered task-table">
        <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Active</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Active</th>
                    </tr>
                </tfoot>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>
                        <div><a href="{{url('/user/'.$user->id)}}">{{ $user->username }}</a></div>
                    </td>
                    <td>
                        <div>{{ $user->email }}</div>
                    </td>
                    <td>
                        <div>{{ $user->role }}</div>
                    </td>
                    <td>
                        <div>{{ $user->active }}</div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection