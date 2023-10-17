@extends('layouts.master')

@section('title')
@lang('warehouses.title')
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">@lang('home.title')</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ @lang('warehouses.title')</span>
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
                <h4 class="card-title mg-b-0">@lang('warehouses.title')<small>{{ $warehouses->total() }}</small></h4>
            </div>
        </div>
        <div class="card-body">
            <div class="row">

                @if(auth()->user()->can('warehouses.create'))
                <div class="col-md-7">
                <a class="btn btn-primary mb-3" href="{{ route('warehouses.create') }}">
                  <i class="fas fa-plus"></i> @lang('warehouses.add_warehouse')
                </a>
                </div>
                @else
                <div class="col-md-7">
                    <a class="btn btn-primary mb-3 disabled" href="{{ route('warehouses.create') }}">
                      <i class="fas fa-plus"></i> @lang('warehouses.add_warehouse')
                    </a>
                </div>
                @endif
                
                <div class="col-md-5">
                <form action="{{ route('warehouses.index') }}" method="get">
                    <div class="input-group mb-2">
                        <input type="text" class="form-control rounded-3 br-te-0 br-be-0" placeholder="@lang('warehouses.search_placeholder')" name="search" value="{{ request()->search }}">
                        <button class="btn ripple btn-primary mx-2" type="submit"><i class="fas fa-search mx-1"></i>@lang('warehouses.search_btn')</button>
                    </div>
                </form>   
                </div>             

            </div>
            <div class="table-responsive mb-3">
                <table class="table table-bordered mg-b-0 text-md-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>                            
                            <th>@lang('warehouses.name')</th>
                            <th>@lang('warehouses.phone')</th>
                            <th>@lang('warehouses.address')</th>
                            <th>@lang('warehouses.related_products')</th>
                            <th>@lang('warehouses.actions')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($warehouses as $warehouse)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $warehouse->name }}</td>
                            <td>{{ $warehouse->phone }}</td>
                            <td>{{ $warehouse->address }}</td>
                            <td><a href="{{ route('products.index', ['warehouse_id' => $warehouse->id]) }}" class="btn btn-info btn-sm">@lang('warehouses.related_products')</a></td>
                            <td>
                                @if(auth()->user()->can('warehouses.edit'))                                
                                <a href="{{route('warehouses.edit', $warehouse->id)}}" class="btn btn-primary btn-sm"><span class="fe fe-edit"></span>@lang('warehouses.edit')</a>
                                @else
                                <a href="{{route('warehouses.edit', $warehouse->id)}}" class="btn btn-primary btn-sm disabled"><span class="fe fe-edit"></span>@lang('warehouses.edit')</a>
                                @endif

                                @if(auth()->user()->can('warehouses.delete'))                                
                                <a href="{{ route('warehouses.destroy', $warehouse->id) }}" class="btn btn-danger btn-sm" data-confirm-delete="true"><span class="fe fe-trash-2"></span>@lang('warehouses.delete')</a>
                                @else
                                <a href="{{ route('warehouses.destroy', $warehouse->id) }}" class="btn btn-danger btn-sm disabled" data-confirm-delete="true"><span class="fe fe-trash-2"></span>@lang('warehouses.delete')</a>
                                @endif
                            </td>
                        </tr>
                        @empty
                            <p>@lang('warehouses.no_warehouses')</p>
                        @endforelse
                    </tbody>
                </table>
                
            </div>
            {{$warehouses->appends(request()->query())->links()}}
        </div>
    </div>
</div>
<!--/div-->
   
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection