@extends('layouts.master')

@section('title')
@lang('orders.title')
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">@lang('home.title')</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ @lang('orders.title')</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')

<!--div-->
<div class="row">
    <div class="col-md-8 col-sm-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">@lang('orders.title')<small>{{ $orders->total() }}</small></h4>
                </div>
            </div>
            <div class="card-body">

                    <form action="{{ route('orders.index') }}" method="get">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control rounded-3 br-te-0 br-be-0" placeholder="@lang('orders.search_pacehoder')" name="search" value="{{ request()->search }}">
                            <button class="btn ripple btn-primary mx-2" type="submit"><i class="fas fa-search mx-1"></i>@lang('orders.search_btn')</button>
                        </div>
                    </form>   

                <div class="table-responsive mb-3">
                    <table class="table table-bordered mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>                            
                                <th>@lang('orders.name')</th>
                                <th>@lang('orders.price')</th>
                                <th>@lang('orders.created_at')</th>
                                <th>@lang('orders.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $order->client->name }}</td>
                                <td>{{ number_format($order->total_price, 2) }}</td>
                                <td>{{ $order->created_at->toFormattedDateString() }}</td>
                                <td>
                                    <button class="btn btn-info btn-sm order-products"
                                    data-url="{{ route('orders.products', $order->id) }}"
                                    >
                                    <span class="fe fe-list"></span>
                                    @lang('orders.show')
                                    </button>

                                    @if(auth()->user()->can('orders.edit'))                                
                                    <a href="{{route('clients.orders.edit', ['client' => $order->client, 'order' => $order])}}" class="btn btn-primary btn-sm"><span class="fe fe-edit"></span>@lang('orders.edit')</a>
                                    @else
                                    <a href="{{route('clients.orders.edit', ['client' => $order->client, 'order' => $order])}}" class="btn btn-primary btn-sm disabled"><span class="fe fe-edit"></span>@lang('orders.edit')</a>
                                    @endif

                                    @if(auth()->user()->can('orders.delete'))                                
                                    <a href="{{ route('orders.destroy', $order) }}" class="btn btn-danger btn-sm" data-confirm-delete="true"><span class="fe fe-trash-2"></span>@lang('orders.delete')</a>
                                    @else
                                    <a href="{{ route('orders.destroy', $order) }}" class="btn btn-danger btn-sm disabled" data-confirm-delete="true"><span class="fe fe-trash-2"></span>@lang('orders.delete')</a>
                                    @endif


                                </td>
                            </tr>
                            @empty
                                <p>@lang('orders.no_orders')</p>
                            @endforelse
                        </tbody>
                    </table>
                    
                </div>
                {{$orders->appends(request()->query())->links()}}
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">@lang('orders.products')</small></h4>
                </div>
            </div>
            <div class="card-body pb-0 px-4">
                <div class="row" id="order-product-list">                        
                    <div style="display: none; flex-direction:column; align-items:center;" id="loading">
                        <span class="loader"></span>
                    </div>   
                </div>
            </div>
        </div>
    </div>
   
</div>
<!--/div-->
   
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection

@push('css')    
	<style>
		.loader {
		width: 48px;
		height: 48px;
		border-radius: 50%;
		position: relative;
		animation: rotate 1s linear infinite
		}
		.loader::before {
		content: "";
		box-sizing: border-box;
		position: absolute;
		inset: 0px;
		border-radius: 50%;
		border: 5px solid #2349bc;
		animation: prixClipFix 2s linear infinite ;
		}

		@keyframes rotate {
		100%   {transform: rotate(360deg)}
		}

		@keyframes prixClipFix {
			0%   {clip-path:polygon(50% 50%,0 0,0 0,0 0,0 0,0 0)}
			25%  {clip-path:polygon(50% 50%,0 0,100% 0,100% 0,100% 0,100% 0)}
			50%  {clip-path:polygon(50% 50%,0 0,100% 0,100% 100%,100% 100%,100% 100%)}
			75%  {clip-path:polygon(50% 50%,0 0,100% 0,100% 100%,0 100%,0 100%)}
			100% {clip-path:polygon(50% 50%,0 0,100% 0,100% 100%,0 100%,0 0)}
		}
	</style>
@endpush