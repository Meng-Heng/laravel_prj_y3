@extends('layout.backend')
@section('content')
            @if(Session::has('product_delete'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Deleted!!</strong> {!! session('product_delete') !!}
                </div>
            @endif
            @if(Session::has('product_create'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Success!!</strong> {!! session('product_create') !!}
                </div>
                @endif
                @if(Session::has('product_update'))
                <div class="alert alert-primary alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Success!</strong> {!! session('product_update') !!}
                </div>
                @endif
                <nav class="navbar navbar-expand navbar-white bg-white">
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{ route('products.search') }}" method="GET">
            <div class="input-group" name="search">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." name="query" >
                <div class="input-group-append">
                    <button class="btn btn-danger" type="submit" name="search">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
                <div class="ml-2">
                    <a class="btn btn-primary" href="{!! url('/product')!!}">Refresh</a>
                </div>
            </div>
        </form>
</nav>
        <div class="table-responsive">
            <div class="my-2">
                <a class="btn btn-primary"  href="{{url('/product/create')}}">Create</a>
            </div>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Material</th>
                        <th>Color</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Brand</th>
                        <th>Created_Date</th>
                        <th>Updated_Date</th>
                        <th colspan=2>Operation</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Material</th>
                        <th>Color</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Brand</th>
                        <th>Created_Date</th>
                        <th>Updated_Date</th>
                        <th colspan=2>Operation</th>
                    </tr>
                </tfoot>
                <tbody>
                @foreach ($product as $products)
                    <tr>
                        <td>
                            <div><a href="{{url('/product/'.$products->id)}}">{{ $products->name }}</a></div>
                        </td>
                        <td>
                            <div>{!! $products->material !!}</div>
                        </td>
                        <td>
                            <div>{!! $products->color !!}</div>
                        </td>
                        <td>
                            <div>{!! $products->price !!}</div>
                        </td>
                        <td>
                              <div>{!! Html::image('/img/'.$products->image, $products->name, array('width'=>'60')) !!}</div>
                        </td>
                        <td>
                            <div>{!! $products->brand->brandName !!}</div>
                        </td>
                        <td>
                            <div>{!! $products->created_at !!}</div>
                        </td>
                        <td>
                            <div>{!! $products->updated_at !!}</div>
                        </td>
                        <td><a class="btn btn-primary" href="{!! url('product/' . $products->id . '/edit') !!}">Edit</a></td>
                        <td>
                                        {!! Form::open(array('url'=>'product/'. $products->id, 'method'=>'DELETE')) !!}
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button class="btn btn-danger delete">Delete</button>
                                        {!! Form::close() !!}
                                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>        
            </div>

@endsection
