@extends('layout.frontend')
@section('content')
<br><br><br><br><br><br><br><br><br>
<div class="container">
    <div class="row">
        <div class="md-12">
            
            <table id="cart" class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th style="width:50%">Product</th>
                        <th style="width:10%">Price</th>
                        <th style="width:8%">Quantity</th>
                        <th style="width:22%" class="text-center">Subtotal</th>
                        <th style="width:10%"></th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0 @endphp
                    @if(session('cart'))
                    @foreach(session('cart') as $id => $products)
                    @php $total += $products['price'] * $products['quantity'] @endphp
                    <tr data-id="{{ $id }}">
                        <td data-th="Product">
                            <div class="row">
                                <div class="col-sm-3 hidden-xs"><img src="img/{{ $products['image'] }}" width="100" height="auto" class="img-responsive" /></div>
                                <div class="col-sm-9">
                                    <h4 class="nomargin">{{ $products['name'] }}</h4>
                                </div>
                            </div>
                        </td>
                        <td data-th="Price">${{ $products['price'] }}</td>
                        <td data-th="Quantity">
                            <input type="number" value="{{ $products['quantity'] }}" class="form-control quantity update-cart" />
                        </td>
                        <td data-th="Subtotal" class="text-center">${{ $products['price'] * $products['quantity'] }}</td>
                        <td class="actions" data-th="">
                            <button class="btn btn-danger btn-sm remove-from-cart"><i class="fa-solid fa-trash fa-fw"></i></button>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="text-right">
                            <h3><strong>Total ${{ $total }}</strong></h3>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-right">
                            
                            <button class="btn btn-success"><a href="{{url('/checkout')}}"></a>Checkout</button>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".update-cart").change(function(e) {
        e.preventDefault();

        var ele = $(this);

        $.ajax({
            url: '{{ route("update.cart") }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}',
                id: ele.parents("tr").attr("data-id"),
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function(response) {
                window.location.reload();
            }
        });
    });

    $(".remove-from-cart").click(function(e) {
        e.preventDefault();

        var ele = $(this);

        if (confirm("Are you sure want to remove?")) {
            $.ajax({
                url: '{{ route("remove.from.cart") }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id")
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        }
    });
</script>


@endsection

