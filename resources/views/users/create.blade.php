@extends('layouts.master')

@section('title')
@lang('users.create_title')
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">@lang('home.title')</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ @lang('users.title')</span>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ @lang('users.create_title')</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row row-sm">
    <div class="col-md-12 col-sm-12">
        <div class="card  box-shadow-0">
            <div class="card-header">
                <h4 class="card-title mb-1">@lang('users.create_form_title')</h4>
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
                <form class="form-horizontal" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" id="inputName" placeholder="@lang('users.name')" name="name" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="@lang('users.email')" name="email" value="{{ old('email') }}">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="inputPassword3" placeholder="@lang('users.password')" name="password">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="inputPassword3" placeholder="@lang('users.confirm_password')" name="password_confirmation">
                    </div>
                    <div class="form-group" data-select2-id="11"> 
                        <select class="form-control" name="role">
                            <option value="" >@lang('users.select_role')</option> 
                            @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>                                
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="formFile" class="form-label">@lang('users.image')</label> 
                        <img src="{{ asset('images/users/default.png') }}" alt="" width="100" class="img-thumbnail" id="blah">
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="file" name="image" accept="image/*" id="imgInp"> 
                    </div>
                    <div class="form-group mb-0 mt-3 justify-content-end">
                        <button type="submit" class="btn btn-primary">@lang('users.add_btn')</button>
                    </div>
                </form>
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

@push('scripts')
<script>
imgInp.onchange = evt => {
    const [file] = imgInp.files
    if (file) {
      blah.src = URL.createObjectURL(file)
    }
  }
</script> 
@endpush