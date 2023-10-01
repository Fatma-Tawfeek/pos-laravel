@extends('layouts.master')

@section('title')
Clients
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Forms</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Clients</span>
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
                <h4 class="card-title mg-b-0">Clients<small>{{ $clients->total() }}</small></h4>
            </div>
        </div>
        <div class="card-body">
            <div class="row">

                <div class="col-md-7">
                <a class="btn btn-primary mb-3" href="{{ route('clients.create') }}">
                  <i class="fas fa-plus"></i> Add Client
                </a>
                </div>
                
                <div class="col-md-5">
                <form action="{{ route('clients.index') }}" method="get">
                    <div class="input-group mb-2">
                        <input type="text" class="form-control rounded-3 br-te-0 br-be-0" placeholder="Search with Name, Phone or Adderess....." name="search" value="{{ request()->search }}">
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
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($clients as $client)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $client->name }}</td>
                            <td>{{ implode(' - ', array_filter($client->phone)) }}</td>
                            <td>{{ $client->address }}</td>
                            <td>
                                <a href="{{route('clients.edit', $client->id)}}" class="btn btn-primary btn-sm"><span class="fe fe-edit"></span>Edit</a>

                                <a href="{{ route('clients.destroy', $client->id) }}" class="btn btn-danger btn-sm" data-confirm-delete="true"><span class="fe fe-trash-2"></span>Delete</a>
                            </td>
                        </tr>
                        @empty
                            <p>There is no clients</p>
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