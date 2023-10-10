@extends('layouts.master')

@section('title')
{{ trans('users.title') }}
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Forms</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('users.title') }}</span>
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
                <h4 class="card-title mg-b-0">{{ trans('users.title') }}<small>{{ $users->total() }}</small></h4>
            </div>
        </div>
        <div class="card-body">
            <div class="row">

                @if(auth()->user()->can('users.create')) 
                <div class="col-md-7">
                <a class="btn btn-primary mb-3" href="{{ route('users.create') }}">
                  <i class="fas fa-plus"></i> Add User
                </a>
                </div>
                @else
                <div class="col-md-7">
                    <a class="btn btn-primary mb-3 disabled" href="{{ route('users.create') }}">
                      <i class="fas fa-plus"></i> Add User
                    </a>
                </div>
                @endif
                
                <div class="col-md-5">
                <form action="{{ route('users.index') }}" method="get">
                    <div class="input-group mb-2">
                        <input type="text" class="form-control rounded-3 br-te-0 br-be-0" placeholder="Search with Name or Email....." name="search" value="{{ request()->search }}">
                        <button class="btn ripple btn-primary mx-2" type="submit"><i class="fas fa-search mx-1"></i>Search</button>
                    </div>
                </form>   
                </div>             

            </div>
            <div class="table-responsive mb-3">
                <table class="table table-bordered mg-b-0 text-md-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>
                                <img src="{{asset('images/users/' . $user->image)}}" alt="" class="rounded-circle" width="50" height="50">
                            </td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td> 
                                @foreach ($user->roles->pluck('name') as $role )
                                    <span class="tag tag-green">{{$role}}</span>     
                                @endforeach 
                            </td>
                            <td>
                                @if(auth()->user()->can('users.edit')) 
                                <a href="{{route('users.edit', $user->id)}}" class="btn btn-primary btn-sm"><span class="fe fe-edit"></span>Edit</a>
                                @else
                                <a href="{{route('users.edit', $user->id)}}" class="btn btn-primary btn-sm disabled"><span class="fe fe-edit"></span>Edit</a>
                                @endif

                                
                                @if ($user->id == 1 || !(auth()->user()->can('users.delete')))
                                  <a href="{{ route('users.destroy', $user->id) }}" class="btn btn-danger btn-sm disabled" data-confirm-delete="true"><span class="fe fe-trash-2"></span>Delete</a>
                                @else   
                                  <a href="{{ route('users.destroy', $user->id) }}" class="btn btn-danger btn-sm" data-confirm-delete="true"><span class="fe fe-trash-2"></span>Delete</a>
                                @endif

                            </td>
                        </tr>
                        @empty
                            <p>There is no Users</p>
                        @endforelse
                    </tbody>
                </table>
                
            </div>
            {{$users->appends(request()->query())->links()}}
        </div>
    </div>
</div>
<!--/div-->
   
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection