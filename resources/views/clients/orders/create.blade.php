@extends('layouts.master')

@section('title')
@lang('orders.add_title')
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">@lang('home.title')</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ @lang('orders.add_title')</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row row-sm">

    {{-- Categories --}}
    <div class="col-md-8 col-sm-12">
        <div class="card  box-shadow-0">
            <div class="card-header">
                <h4 class="card-title mb-1">@lang('orders.categories')</h4>
            </div>
            <div class="card-body pt-0">
            <div class="tr-job-posted section-padding">
                <div class="container">
                    <div class="job-tab text-center">
                        <ul class="nav nav-tabs justify-content-center" role="tablist">
                            @foreach ( $categories as $category )  
                            <li role="presentation" class="{{ $loop->iteration == 1 ? 'active' : '' }}">
                                <a class="{{ $loop->iteration == 1 ? 'active show' : '' }} border border-primary mt-2" href="#category{{ $category->id }}" aria-controls="category{{ $category->id }}" role="tab" data-toggle="tab" aria-selected="true">{{ $category->name }}</a>
                            </li>
                            @endforeach			
                        </ul>

                        <div class="tab-content text-left">
                            @foreach ( $categories as $category )  
                            <div role="tabpanel" class="tab-pane fade show {{ $loop->iteration == 1 ? 'active' : '' }}" id="category{{ $category->id }}">
                                <div class="row">
                                    @foreach ($category->products as $product )

                                    <div class="col-md-6 col-lg-2">
                                        <div class="job-item">
                                            <div class="product-custom-card">
                                                <div 
                                                class="position-relative h-100 card add-product-btn"
                                                id="product-{{ $product->id }}"
                                                data-name="{{ $product->name }}"
                                                data-id="{{ $product->id }}"
                                                data-price="{{ $product->sale_price }}"
                                                >
                                                    <img class="card-img-top" height="100" src="{{ asset('images/products/' . $product->image ) }}">
                                                    <div class="px-2 pt-2 pb-1 custom-card-body card-body">
                                                        <p class="font-weight-bold mb-0 text-gray-900">{{ $product->name }}</p>
                                                        <p class="m-0 item-badges">
                                                            <span class="product-custom-card__card-badge badge text-white bg-info">@lang('products.stock'): {{ $product->stock }}</span>
                                                        </p>
                                                        <p class="m-0 item-badge"><span class="product-custom-card__card-badge badge text-white bg-primary">{{ $product->sale_price }}{{ app('settings')['currency'] }}</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>	
                    </div>	
                </div>
            </div>		
        </div>
    </div>
</div>
 

    {{-- Orders --}}
    <div class="col-md-4 col-sm-12">
        <div class="card  box-shadow-0">
            <div class="card-header">
                <h4 class="card-title mb-1">@lang('orders.order')</h4>
            </div>
            <div class="card-body pt-0">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{ route('clients.orders.store', $client) }}" method="post">
                    @csrf
                    <div class="table-responsive mb-3">
                        <table class="table table-bordered mg-b-0 text-md-nowrap">
                            <thead>
                                <tr>
                                    <th>@lang('orders.product')</th>
                                    <th>@lang('orders.quantity')</th>
                                    <th>@lang('orders.price')</th>
                                    <th>@lang('orders.delete')</th>
                                </tr>
                            </thead>
                            <tbody class="order-list">
                            </tbody>
                        </table>                    
                    </div>
                    <h4>@lang('orders.total') : <span class="total-price">0</span> {{ app('settings')['currency'] }} </h4>
                    <button class="btn btn-primary btn-block disabled" type="submit" id="add-order-form-btn">@lang('orders.add_client')</button>
                </form>
            </div>
        </div>

        <div class="card  box-shadow-0">
            <div class="card-header">
                <h4 class="card-title mb-1">@lang('orders.previous_orders') <small>{{ $orders->total() }}</small></h4>
            </div>
            <div class="card-body pt-0">

                @foreach ( $orders as $order )   
                <p>         
                <a class="btn btn-success" data-toggle="collapse" href="#order{{ $order->created_at->format('d-m-Y-s') }}">{{ $order->created_at->toFormattedDateString() }}</a> 
                </p>              
                <div class="collapse" id="order{{ $order->created_at->format('d-m-Y-s') }}">
                    <div class="card card-body">
                        <ul class="list-group">
                            @foreach ($order->products as $product)
                                <li class="list-group-item">{{ $product->name }}</li>
                            @endforeach
                            <li class="list-group-item bg-light">@lang('orders.total') : {{ $order->total_price }} {{ app('settings')['currency'] }}</li>
                        </ul>
                    </div>
                </div>                    
                @endforeach

            {{ $orders->links() }}

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

@push('css')

<style>

/* Tr Job Post */

.job-item {
    background-color: #fff;
}

.job-tab .nav-tabs {
	margin-bottom: 60px;
	border-bottom: 0;
}

.job-tab .nav-tabs>li {
	float: none;
	display: inline;
}

.job-tab .nav-tabs li {
	margin-right: 15px;
}

.job-tab .nav-tabs li:last-child {
	margin-right: 0;
}

.job-tab .nav-tabs {
	position: relative;
	z-index: 1;
	display: inline-block;
}

.job-tab .nav-tabs:after {
	position: absolute;
	content: "";
	top: 50%;
	left: 0;
	width: 100%;
	height: 1px;
	background-color: #fff;
	z-index: -1;
}



.job-tab .nav-tabs>li a {
	display: inline-block;
	background-color: #fff;
	border: none;
	border-radius: 30px;
	font-size: 14px;
	color: #000;
	padding: 5px 30px;
}

.job-tab .nav-tabs>li>a.active, 
.job-tab .nav-tabs>li a.active>:focus, 
.job-tab .nav-tabs>li>a.active:hover,
.job-tab .nav-tabs>li>a:hover {
	border: none;
	background-color: #008def;
	color: #fff;
}

.job-item {
	border-radius: 3px;
	position: relative;
	margin-bottom: 30px;
	z-index: 1;
}

.job-item .btn.btn-primary {
	text-transform: capitalize;
}

.job-item .job-info {
	font-size: 14px;
	color: #000;
	overflow: hidden;
	padding: 40px 25px 20px;
}

.job-info .company-logo {
	margin-bottom: 30px;
}

.job-info .tr-title {
	margin-bottom: 15px;
}

.job-info .tr-title span {
	font-size: 14px;
	display: block;
}

.job-info .tr-title a {
	color: #000;
}

.job-info .tr-title a:hover {
	color: #008def;
}

.job-info ul {
	margin-bottom: 30px;
}

.job-meta li,
.job-meta li a {
	color: #646464;	
}

.job-meta li a:hover {
	color: #008def;
}

.job-meta li {
	font-size: 12px;
	margin-bottom: 10px;
}

.job-meta li span i {
	color: #000;
}

.job-meta li i {
	margin-right: 15px;
}

.job-item .time {
	position: relative;
}

.job-item .time:after {
	position: absolute;
	content: "";
	bottom: 35px;
	left: -50px;
	width: 150%;
	height: 1px;
	background-color: #f5f4f5;
	z-index: -1;
}

.job-item:hover .time,
.job-item:hover .time:after {
	opacity: 0;
}

.job-item .time span {
	font-size: 12px;
	color: #bebebe;
	line-height: 25px;
}

.job-item .btn.btn-primary,
.role .btn.btn-primary,
.job-item .time a span {
	padding: 5px 10px;
    border-radius: 4px;
    line-height: 10px;
    font-size: 12px;
}

.job-item .time a span {
	color: #fff;
    background-color: #f1592a;
    border-color: #f1592a;	
}

.job-item .time a span.part-time {
	background-color: #00aeef;
	border-color: #00aeef;
}

.job-item .time a span.freelance {
	background-color: #92278f;
	border-color: #92278f;	
}

.job-item .item-overlay {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	border-radius: 5px;
	background-color: #008def;
	color: #fff;
	opacity: 0;
	-webkit-transition: all 800ms;
	-moz-transition: all 800ms;
	-ms-transition: all 800ms;
	-o-transition: all 800ms;
	transition: all 800ms;
}

.job-item:hover .item-overlay {
	opacity: 1;
}

.item-overlay .job-info {
	padding: 45px 25px 40px;
	overflow: hidden;
}

.item-overlay .btn.btn-primary {
	background-color: #007bd4;
	border-color: #007bd4;
	margin-bottom: 10px;
}

.item-overlay .job-info,
.item-overlay .job-info ul li,
.item-overlay .job-info ul li i,
.item-overlay .job-info .tr-title a {
	color: #fff;
}

.job-social {
	margin-top: 35px;
}

.job-social li {
	float: left;
}

.job-social li + li {
	margin-left: 15px;
}

.job-social li a i {
	margin-right: 0;
	font-size: 14px;
}

.job-social li a {
	width: 35px;
	height: 35px;
	text-align: center;
	display: block;
	background-color: #007bd4;
	line-height: 35px;
	border-radius: 100%;
	border: 1px solid #007bd4;
	position: relative;
	overflow: hidden;
	z-index: 1;
}

.job-social li:last-child a {
	background-color: #fff;
}

.job-social li:last-child a i {
	color: #008def;
}

.job-social li a:before {
	position: absolute;
	content: "";
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	z-index: -1;
	border-radius: 100%;
	background-color:#008def;
    -webkit-transform: scale(0);
    -moz-transform: scale(0);
    -ms-transform: scale(0);
    transform: scale(0);	
}

.job-social li a:hover:before {
    -webkit-transform: scale(1);
    -moz-transform: scale(1);
    -ms-transform: scale(1);
    transform: scale(1);
    padding: 5px;
}

.job-social li a:hover {
	border-color: #fff;
}

.job-social li a:hover i {
	color: #fff;
}

.tr-list {
    margin: 0;
    padding: 0;
    list-style: none;
}

</style>
    
@endpush