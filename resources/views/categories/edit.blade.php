@extends('layouts.master')

@section('title')
 @lang('categories.edit_title')
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">@lang('home.title')</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ @lang('categories.title')</span>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ @lang('categories.edit_title')</span>
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
                <h4 class="card-title mb-1">@lang('categories.edit_form_title')</h4>
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
                <form class="form-horizontal" action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" >
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="inputName">@lang('categories.name') <small class="text-danger">(@lang('categories.arabic'))</small></label>
                            <input type="text" class="form-control" id="inputName" placeholder="Name" name="name_ar" value="{{ $category->getTranslation('name', 'ar') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputName">@lang('categories.name')<small class="text-danger">(@lang('categories.english'))</small></label>
                            <input type="text" class="form-control" id="inputName" placeholder="Name" name="name_en" value="{{ $category->getTranslation('name', 'en') }}">
                        </div>
                    </div> 
                    <div class="form-group mb-0 mt-3 justify-content-end">
                        <div>
                            <button type="submit" class="btn btn-primary">@lang('categories.edit_btn')</button>
                        </div>
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