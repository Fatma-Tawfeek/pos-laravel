@extends('layouts.master')

@section('title')
Add Order
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Forms</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Form-Validation</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row row-sm">

    {{-- Categories --}}
    <div class="col-md-6 col-sm-12">
        <div class="card  box-shadow-0">
            <div class="card-header">
                <h4 class="card-title mb-1">Categories</h4>
            </div>
            <div class="card-body pt-0">
                @forelse ( $categories as $category )   
                <p>         
                <a class="btn btn-primary" data-toggle="collapse" href="#category{{ $category->id }}" aria-controls="collapseExample" aria-expanded="false" role="button">
                    {{ $category->name }}
                </a>  
                </p>              
                <div class="collapse" id="category{{ $category->id }}">
                    <div class="card card-body">
                        <div class="table-responsive mb-3">
                            <table class="table table-bordered mg-b-0 text-md-nowrap">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Stock</th>
                                        <th>Price</th>
                                        <th>Add</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($category->products as $product )
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>{{ $product->sale_price }}</td>
                                        <td>
                                            <a 
                                            href="#" 
                                            class="btn btn-success btn-sm add-product-btn"
                                            id="product-{{ $product->id }}"
                                            data-name="{{ $product->name }}"
                                            data-id="{{ $product->id }}"
                                            data-price="{{ $product->sale_price }}">
                                            <i class="fas fa-plus"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>                    
                        </div>
                    </div>
                </div>                    
                @empty
                    <p>There is no categories</p>
                @endforelse

              </div>
            </div>
        </div>

    {{-- Orders --}}
    <div class="col-md-6 col-sm-12">
        <div class="card  box-shadow-0">
            <div class="card-header">
                <h4 class="card-title mb-1">Orders</h4>
            </div>
            <div class="card-body pt-0">
                <form action="" method="post">
                    @csrf
                    <div class="table-responsive mb-3">
                        <table class="table table-bordered mg-b-0 text-md-nowrap">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody class="order-list">
                            </tbody>
                        </table>                    
                    </div>
                    <h4>Total : <span class="total-price">0</span> </h4>
                    <button class="btn btn-primary disabled" type="submit" id="add-order-form-btn">Add Order</button>
                </form>
               

            </div>
        </div>
    </div>

</div>
<!-- row -->
    </div>
    <!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection