@extends('layout.backend')
@section('content')

@if (count($products) > 0)
<nav class="navbar navbar-expand navbar-white bg-gray">
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
<div class="panel panel-default">

    <div class="panel-body">
        <table class="table table-bordered task-table">
            <thead>
                <th>Name</th>
                <th>Material</th>
                <th>Color</th>
                <th>Price</th>
                <th>Image</th>
                <th>Brand</th>
            </thead>
            <tfoot>
                <th>Name</th>
                <th>Material</th>
                <th>Color</th>
                <th>Price</th>
                <th>Image</th>
                <th>Brand</th>
            </tfoot>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>
                        <div><a href="{{url('/product/'.$product->id)}}">{{ $product->name }}</a></div>
                    </td>
                    <td>
                        <div>{{ $product->material }}</div>
                    </td>
                    <td>
                        <div>{{ $product->color }}</div>
                    </td>
                    <td>
                        <div>{{ $product->price }}</div>
                    </td>
                    <td>
                        <div>{{ Html::image('img/'.$product->image, $product->name, array('width'=>'60')) }}</div>
                    </td>
                    <td>
                        <div>{{ $product->brand->brandName }}</div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    $(".delete").click(function() {
        var form = $(this).closest('form');
        $('<div></div>').appendTo('body')
            .html('<div><h6> Are you sure ?</h6></div>')
            .dialog({
                modal: true,
                title: 'Delete message',
                zIndex: 10000,
                autoOpen: true,
                width: 'auto',
                resizable: false,
                buttons: {
                    Yes: function() {
                        $(this).dialog('close');
                        form.submit();
                    },
                    No: function() {
                        $(this).dialog("close");
                        return false;
                    }
                },
                close: function(event, ui) {
                    $(this).remove();
                }
            });
        return false;
    });
</script>
@endif
@endsection