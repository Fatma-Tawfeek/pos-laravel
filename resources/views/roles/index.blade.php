@extends('layouts.master')

@section('title')
    @lang('roles.title')
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">@lang('home.title')</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ @lang('roles.title')</span>
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
                <h4 class="card-title mg-b-0">@lang('roles.title') </h4>
            </div>
        </div>
        <div class="card-body">
            @if(auth()->user()->can('orders.create'))                                
            <a class="btn btn-primary mb-3" href="{{ route('roles.create') }}">
                <i class="fas fa-plus"></i> @lang('roles.create_title')
            </a>
            @else
            <a class="btn btn-primary mb-3 disabled" href="{{ route('roles.create') }}">
                <i class="fas fa-plus"></i> @lang('roles.create_title')
            </a>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered mg-b-0 text-md-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('roles.name')</th>
                            <th>@lang('roles.permissions')</th>
                            <th>@lang('roles.actions')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$role->name}}</td>
                            <td width="60%">
                                @foreach ($role->permissions as $permission)
                                    <span class="tag tag-green mb-1">{{$permission->name}}</span>
                                @endforeach
                            </td>
                            <td>
                                @if(auth()->user()->can('roles.edit'))                                
                                <a href="{{route('roles.edit', $role->id)}}" class="btn btn-primary btn-sm"><span class="fe fe-edit"></span>@lang('roles.edit')</a>
                                @else
                                <a href="{{route('roles.edit', $role->id)}}" class="btn btn-primary btn-sm disabled"><span class="fe fe-edit"></span>@lang('roles.edit')</a>
                                @endif
                                
                                @if(auth()->user()->can('roles.delete'))                                
                                <a href="{{ route('roles.destroy', $role->id) }}" class="btn btn-danger btn-sm" data-confirm-delete="true"><span class="fe fe-trash-2"></span>@lang('roles.delete')</a>  
                                @else
                                <a href="{{ route('roles.destroy', $role->id) }}" class="btn btn-danger btn-sm disabled" data-confirm-delete="true"><span class="fe fe-trash-2"></span>@lang('roles.delete')</a>  
                                @endif               
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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