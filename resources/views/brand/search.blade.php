@extends('layout.backend')
@section('content')

@if (count($brands) > 0)
<nav class="navbar navbar-expand navbar-white bg-gray">
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{ route('brands.search') }}" method="GET">
            <div class="input-group" name="search">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." name="query" >
                <div class="input-group-append">
                    <button class="btn btn-danger" type="submit" name="search">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
                <div class="ml-2">
                    <a class="btn btn-primary" href="{!! url('/brand')!!}">Refresh</a>
                </div>
            </div>
        </form>
</nav>
<div class="panel panel-default">

    <div class="panel-body">
        <table class="table table-bordered task-table">
        <thead>
                    <tr>
                        <th>Brand Name</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Brand Name</th>
                        <th>Description</th>
                    </tr>
                </tfoot>
            <tbody>
                @foreach ($brands as $brand)
                <tr>
                    <td>
                        <div><a href="{{url('/brand/'.$brand->id)}}">{{ $brand->brandName }}</a></div>
                    </td>
                    <td>
                        <div>{{ $brand->description }}</div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection