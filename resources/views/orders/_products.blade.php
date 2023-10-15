<div class="table-responsive mb-3">
    <div id="print-area">
        <table class="table table-bordered mg-b-0 text-md-nowrap">
            <thead>
                <tr>
                    <th>@lang('orders.product_name')</th>
                    <th>@lang('orders.quantity')</th>
                    <th>@lang('orders.product_price')</th>
                </tr>
            </thead>
            <tbody>  
                @foreach ( $products as $product )
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->pivot->quantity }}</td>
                    <td>{{ number_format($product->pivot->quantity * $product->sale_price, 2) }} {{ app('settings')['currency'] }}</td>
                 </tr>
                @endforeach         
            </tbody>
        </table>
        <h3 class="mt-2">@lang('orders.total') : <span>{{ number_format($order->total_price, 2) }} {{ app('settings')['currency'] }}</span></h3>         
    </div>   
    <button class="btn btn-primary btn-block print-btn"><i class="fas fa-print mx-1"></i>@lang('orders.print')</button> 
</div>