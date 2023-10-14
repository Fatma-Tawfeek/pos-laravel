@extends('layouts.master')

@section('title')
    @lang('products.title')
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">@lang('home.title')</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ @lang('products.title')</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')

<!--div-->
<div class="col-xl-12">
    <div class="card mg-b-20">
        <div class="card-header pb-0">
            <div class="d-flex justify-content-between">
                <h4 class="card-title mg-b-0">@lang('products.title') <small>{{ $products->total() }}</small></h4>
            </div>
        </div>
        <div class="card-body">
            <div class="row">

                @if(auth()->user()->can('products.create'))
                <div class="col-md-5">
                    <a class="btn btn-primary mb-3" href="{{ route('products.create') }}">
                      <i class="fas fa-plus"></i> @lang('products.add_product')
                    </a>
                </div>
                @else
                <div class="col-md-5">
                    <a class="btn btn-primary mb-3 disabled" href="{{ route('products.create') }}">
                      <i class="fas fa-plus"></i> @lang('products.add_product')
                    </a>
                </div>
                @endif    
                         
                <div class="col-md-7">
                <form action="{{ route('products.index') }}" method="get">
                    <div class="input-group mb-2">
                        {{-- category filter --}}
                        <select name="category_id" id="" class="form-control mx-2">
                            <option value="">@lang('products.select_category')</option>
                            @foreach ($categories as $category) 
                            <option value="{{ $category->id }}" {{ request()->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>                                
                            @endforeach
                        </select>
                            {{-- search --}}
                        <input type="text" class="form-control rounded-3 br-te-0 br-be-0" placeholder="@lang('products.search_placeholder')" name="search" value="{{ request()->search }}">
                        <button class="btn ripple btn-primary mx-2" type="submit"><i class="fas fa-search mx-1"></i>@lang('products.search_btn')</button>                            
                    </div>
                </form>   
                </div>             

            </div>
            <div class="table-responsive mb-3">
                <table class="table table-bordered mg-b-0 text-md-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('products.image')</th>
                            <th>@lang('products.name')</th>
                            <th>@lang('products.description')</th>
                            <th>@lang('products.category')</th>
                            <th>@lang('products.purchase_price')</th>
                            <th>@lang('products.sale_price')</th>
                            <th>@lang('products.profit_percent')</th>
                            <th>@lang('products.stock')</th>
                            <th>@lang('products.actions')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td><img src="{{ asset('images/products/' . $product->image) }}" alt="product" class="rounded-circle" width="50" height="50"></td>
                            <td>{{$product->name}}</td>
                            <td>{!! Str::limit($product->description, 15) !!}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->purchase_price }}</td>
                            <td>{{ $product->sale_price }}</td>
                            <td>{{ $product->profit_percent }} %</td>
                            <td>{{ $product->stock }}</td>
                            <td>

                                @if(auth()->user()->can('products.edit'))
                                <a href="{{route('products.edit', $product->id)}}" class="btn btn-primary btn-sm"><span class="fe fe-edit"></span>@lang('products.edit')</a>
                                @else
                                <a href="{{route('products.edit', $product->id)}}" class="btn btn-primary btn-sm disabled"><span class="fe fe-edit"></span>@lang('products.edit')</a>
                                @endif

                                @if(auth()->user()->can('products.delete'))
                                <a href="{{ route('products.destroy', $product->id) }}" class="btn btn-danger btn-sm" data-confirm-delete="true"><span class="fe fe-trash-2"></span>@lang('products.delete')</a>  
                                @else
                                <a href="{{ route('products.destroy', $product->id) }}" class="btn btn-danger btn-sm disabled" data-confirm-delete="true"><span class="fe fe-trash-2"></span>@lang('products.delete')</a>                                                                      
                                @endif

                            </td>
                        </tr>
                        @empty
                            <h3>@lang('products.no_products')</h3>
                        @endforelse
                    </tbody>
                </table>
                
            </div>
            {{$products->appends(request()->query())->links()}}
        </div>
    </div>
</div>
<!--/div-->
   
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection