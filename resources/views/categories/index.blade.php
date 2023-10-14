@extends('layouts.master')

@section('title')
    @lang('categories.title')
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">@lang('home.title')</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ @lang('categories.title')</span>
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
                <h4 class="card-title mg-b-0">@lang('categories.title') <small>{{ $categories->total() }}</small></h4>
            </div>
        </div>
        <div class="card-body">
            <div class="row">

                @if(auth()->user()->can('categories.create'))
                    <div class="col-md-7">
                        <a class="btn btn-primary mb-3" href="{{ route('categories.create') }}">
                        <i class="fas fa-plus"></i> @lang('categories.add_category')
                        </a>
                    </div>
                @else
                <div class="col-md-7">
                    <a class="btn btn-primary mb-3 disabled" href="{{ route('categories.create') }}">
                    <i class="fas fa-plus"></i> @lang('categories.add_category')
                    </a>
                </div>
                @endif       
                         
                <div class="col-md-5">
                <form action="{{ route('categories.index') }}" method="get">
                    <div class="input-group mb-2">
                        <input type="text" class="form-control rounded-3 br-te-0 br-be-0" placeholder="@lang('categories.search_placeholder')" name="search" value="{{ request()->search }}">
                        <button class="btn ripple btn-primary mx-2" type="submit"><i class="fas fa-search mx-1"></i>@lang('categories.search_btn')</button>
                    </div>
                </form>   
                </div>             

            </div>
            <div class="table-responsive mb-3">
                <table class="table table-bordered mg-b-0 text-md-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('categories.name')</th>
                            <th>@lang('categories.product_count')</th>
                            <th>@lang('categories.related_products')</th>
                            <th>@lang('categories.actions')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$category->name}}</td>
                            <td>{{ $category->products()->count() }}</td>
                            <td><a href="{{ route('products.index', ['category_id' => $category->id]) }}" class="btn btn-info btn-sm">@lang('categories.related_products')</a></td>
                            <td>

                                @if(auth()->user()->can('categories.edit'))
                                <a href="{{route('categories.edit', $category->id)}}" class="btn btn-primary btn-sm"><span class="fe fe-edit"></span>@lang('categories.edit')</a>
                                @else
                                <a href="{{route('categories.edit', $category->id)}}" class="btn btn-primary btn-sm disabled"><span class="fe fe-edit"></span>@lang('categories.edit')</a>
                                @endif

                                @if(auth()->user()->can('categories.delete'))
                                <a href="{{ route('categories.destroy', $category->id) }}" class="btn btn-danger btn-sm" data-confirm-delete="true"><span class="fe fe-trash-2"></span>@lang('categories.delete')</a>                                    
                                @else
                                <a href="{{ route('categories.destroy', $category->id) }}" class="btn btn-danger btn-sm disabled" data-confirm-delete="true"><span class="fe fe-trash-2"></span>@lang('categories.delete')</a>                                    
                                @endif

                            </td>
                        </tr>
                        @empty
                            <h3>@lang('categories.no_categories')</h3>
                        @endforelse
                    </tbody>
                </table>
                
            </div>
            {{$categories->appends(request()->query())->links()}}
        </div>
    </div>
</div>
<!--/div-->
   
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection