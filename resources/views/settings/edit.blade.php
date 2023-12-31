@extends('layouts.master')

@section('title')
@lang('settings.title')
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">@lang('home.title')</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ @lang('settings.title')</span>
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
                <h4 class="card-title mb-1">@lang('settings.form_title')</h4>
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
                <form class="form-horizontal" action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        <div class="form-group">
                            <label for="inputName">@lang('settings.name')</label>
                            <input type="text" class="form-control" id="inputName" name="app_name" value="{{ app('settings')['app_name'] }}">
                        </div>
                        <div class="form-group">
                            <label for="inputDesc">@lang('settings.description')</label>
                            <textarea name="desc" class="form-control" id="inputDesc" cols="30" rows="5">{{ app('settings')['description'] }}</textarea>
                        </div>   

                    <div class="row">                        
                        <div class="form-group col-md-6">
                            <label for="formFile" class="form-label">@lang('settings.logo')</label> 
                            <img src="{{ asset('assets/img/brand/' . app('settings')['logo'] ) }}" alt="logo" width="100" class="img-thumbnail mb-2" id="logo">
                            <input class="form-control" type="file" name="logo" accept="image/*" id="logoInp"> 
                        </div>
    
                        <div class="form-group col-md-6">
                            <label for="formFile" class="form-label">@lang('settings.favicon')</label> 
                            <img src="{{ asset('assets/img/brand/' . app('settings')['favicon'] ) }}" alt="favicon" height="30" class="img-thumbnail mb-2" id="fav">
                            <input class="form-control" type="file" name="favicon" accept="image/*" id="favInp"> 
                        </div>
                    </div>
  
                    <div class="form-group">
                        <label for="inputName">@lang('settings.currency')</label>
                        <input type="text" class="form-control" id="inputName" name="currency" value="{{ app('settings')['currency'] }}">
                    </div>        
                    <div class="form-group mb-0 mt-3 justify-content-end">
                        <button type="submit" class="btn btn-primary">@lang('products.edit_btn')</button>
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
logoInp.onchange = evt => {
    const [file] = logoInp.files
    if (file) {
      logo.src = URL.createObjectURL(file)
    }
  }

  favInp.onchange = evt => {
    const [file] = favInp.files
    if (file) {
      fav.src = URL.createObjectURL(file)
    }
  }
</script> 
@endpush