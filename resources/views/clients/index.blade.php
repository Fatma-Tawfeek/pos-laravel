@extends('layouts.master')

@section('title')
@lang('clients.title')
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">@lang('home.title')</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ @lang('clients.title')</span>
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
                <h4 class="card-title mg-b-0">@lang('clients.title')<small>{{ $clients->total() }}</small></h4>
            </div>
        </div>
        <div class="card-body">
            <div class="row">

                @if(auth()->user()->can('clients.create'))
                <div class="col-md-7">
                <a class="btn btn-primary mb-3" href="{{ route('clients.create') }}">
                  <i class="fas fa-plus"></i> @lang('clients.add_client')
                </a>
                </div>
                @else
                <div class="col-md-7">
                    <a class="btn btn-primary mb-3 disabled" href="{{ route('clients.create') }}">
                      <i class="fas fa-plus"></i> @lang('clients.add_client')
                    </a>
                </div>
                @endif
                
                <div class="col-md-5">
                <form action="{{ route('clients.index') }}" method="get">
                    <div class="input-group mb-2">
                        <input type="text" class="form-control rounded-3 br-te-0 br-be-0" placeholder="@lang('clients.search_pacehoder')" name="search" value="{{ request()->search }}">
                        <button class="btn ripple btn-primary mx-2" type="submit"><i class="fas fa-search mx-1"></i>@lang('clients.search_btn')</button>
                    </div>
                </form>   
                </div>             

            </div>
            <div class="table-responsive mb-3">
                <table class="table table-bordered mg-b-0 text-md-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>                            
                            <th>@lang('clients.name')</th>
                            <th>@lang('clients.phone')</th>
                            <th>@lang('clients.address')</th>
                            <th>@lang('clients.add_order')</th>
                            <th>@lang('clients.actions')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($clients as $client)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $client->name }}</td>
                            <td>{{ is_array($client->phone) ? implode(' - ', array_filter($client->phone)) : $client->phone }}</td>
                            <td>{{ $client->address }}</td>
                            <td>
                                @if(auth()->user()->can('orders.create'))                                
                                <a href="{{ route('clients.orders.create', $client) }}" class="btn btn-info btn-sm">@lang('clients.add_order')</a>
                                @else
                                <a href="{{ route('clients.orders.create', $client) }}" class="btn btn-info btn-sm disabled">@lang('clients.add_order')</a>
                                @endif
                            </td>
                            <td>
                                @if(auth()->user()->can('clients.edit'))                                
                                <a href="{{route('clients.edit', $client->id)}}" class="btn btn-primary btn-sm"><span class="fe fe-edit"></span>@lang('clients.edit')</a>
                                @else
                                <a href="{{route('clients.edit', $client->id)}}" class="btn btn-primary btn-sm disabled"><span class="fe fe-edit"></span>@lang('clients.edit')</a>
                                @endif

                                @if(auth()->user()->can('clients.delete'))                                
                                <a href="{{ route('clients.destroy', $client->id) }}" class="btn btn-danger btn-sm" data-confirm-delete="true"><span class="fe fe-trash-2"></span>@lang('clients.delete')</a>
                                @else
                                <a href="{{ route('clients.destroy', $client->id) }}" class="btn btn-danger btn-sm disabled" data-confirm-delete="true"><span class="fe fe-trash-2"></span>@lang('clients.delete')</a>
                                @endif
                            </td>
                        </tr>
                        @empty
                            <p>@lang('clients.no_clients')</p>
                        @endforelse
                    </tbody>
                </table>
                
            </div>
            {{$clients->appends(request()->query())->links()}}
        </div>
    </div>
</div>
<!--/div-->
   
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection