<div class="table-responsive mb-3">
    <div id="print-area">
        <table class="table table-bordered mg-b-0 text-md-nowrap">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>  
                @foreach ( $products as $product )
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->pivot->quantity }}</td>
                    <td>{{ number_format($product->pivot->quantity * $product->sale_price, 2) }}</td>
                 </tr>
                @endforeach         
            </tbody>
        </table>
        <h3 class="mt-2">Total : <span>{{ number_format($order->total_price, 2) }}</span></h3>         
    </div>   
    <button class="btn btn-primary btn-block print-btn"><i class="fas fa-print mx-1"></i>print</button> 
</div>