@extends('layouts.master')

@section('title')
    Roles
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

<!--div-->
<div class="col-xl-12">
    <div class="card mg-b-20">
        <div class="card-header pb-0">
            <div class="d-flex justify-content-between">
                <h4 class="card-title mg-b-0">Roles </h4>
            </div>
        </div>
        <div class="card-body">
            <a class="btn btn-primary mb-3" href="{{ route('roles.create') }}">
                <i class="fas fa-plus"></i> Add Role
            </a>
            <div class="table-responsive">
                <table class="table table-bordered mg-b-0 text-md-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Role Name</th>
                            <th>Permissions</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$role->name}}</td>
                            <td>
                                @foreach ($role->permissions as $permission)
                                    {{-- <span class="badge badge-info">{{$permission->name}}</span> --}}
                                    <span class="tag tag-green">{{$permission->name}}</span>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{route('roles.edit', $role->id)}}" class="btn btn-primary btn-sm"><span class="fe fe-edit"></span>ُEdit</a>
                                <form action="{{route('roles.destroy', $role->id)}}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><span class="fe fe-trash-2"></span>Delete</button>
                                </form>
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