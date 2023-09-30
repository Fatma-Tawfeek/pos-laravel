@extends('layouts.master')

@section('title')
Add Product
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
<!-- row -->
<div class="row row-sm">
    <div class="col-md-12 col-sm-12">
        <div class="card  box-shadow-0">
            <div class="card-header">
                <h4 class="card-title mb-1">Add Product Form</h4>
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
                <form class="form-horizontal" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="inputCategory">Category</label>
                        <select name="category_id" id="inputCategory" class="form-control">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category )
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>                                
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="inputName">Name <small class="text-danger">(العربية)</small></label>
                            <input type="text" class="form-control" id="inputName" placeholder="Name" name="name_ar" value="{{ old('name_ar') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputName">Name <small class="text-danger">(English)</small></label>
                            <input type="text" class="form-control" id="inputName" placeholder="Name" name="name_en" value="{{ old('name_en') }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputDesc">Description <small class="text-danger">(العربية)</small></label>
                            <textarea name="desc_ar" class="form-control" id="editor_ar" cols="30" rows="10" placeholder="Description in Arabic">{{ old('desc_ar') }}</textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputDesc">Description <small class="text-danger">(English)</small></label>
                            <textarea name="desc_en" class="form-control" id="editor_en" cols="30" rows="10" placeholder="Description in English">{{ old('desc_en') }}</textarea>
                        </div>     
                    </div>  
                    <div class="form-group">
                        <label for="formFile" class="form-label">Image</label> 
                        <img src="{{ asset('images/products/default.png') }}" alt="" width="100" class="img-thumbnail" id="blah">
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="file" name="image" accept="image/*" id="imgInp"> 
                    </div>   
                    <div class="form-group">
                        <label for="inputName">Purchase Price</label>
                        <input type="number" class="form-control" id="inputName" placeholder="Purchase Price" name="purchase_price" value="{{ old('purchase_price') }}">
                    </div>  
                    <div class="form-group">
                        <label for="inputName">Sale Price</label>
                        <input type="number" class="form-control" id="inputName" placeholder="Sale Price" name="sale_price" value="{{ old('sale_price') }}">
                    </div>   
                    <div class="form-group">
                        <label for="inputName">Stock</label>
                        <input type="number" class="form-control" id="inputName" placeholder="Stock" name="stock" value="{{ old('stock') }}">
                    </div>        
                    <div class="form-group mb-0 mt-3 justify-content-end">
                        <button type="submit" class="btn btn-primary">Add</button>
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
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
<script>
// ckeditor
ClassicEditor
    .create( document.querySelector( '#editor_ar' ), {
        // The language code is defined in the https://en.wikipedia.org/wiki/ISO_639-1 standard.
        language: "{{ app()->getLocale() }}"
    } )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );

    ClassicEditor
    .create( document.querySelector( '#editor_en' ), {
        // The language code is defined in the https://en.wikipedia.org/wiki/ISO_639-1 standard.
        language: "{{ app()->getLocale() }}"
    } )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );

// Image Preview
imgInp.onchange = evt => {
    const [file] = imgInp.files
    if (file) {
      blah.src = URL.createObjectURL(file)
    }
  }
</script>
@endpush