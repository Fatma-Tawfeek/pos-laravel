@extends('layouts.master')

@section('title')
@lang('roles.create_title')
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">@lang('home.title')</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ @lang('roles.title')</span>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ @lang('roles.create_title')</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card mg-b-20">
            <div class="card-body">

                <div class="card-header py-0 px-0">      
                    <h4 class="card-title ">@lang('roles.create_form_title')</h4>
                </div>
    
                <form action="{{route('roles.store')}}" method="POST">
                    @csrf                            
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                
                    <div class="my-3">
                        <input type="text" value="{{old('name')}}" name="name" id="name" class="form-control" placeholder="@lang('roles.name')" >
                    </div>

                    <label for="name" class="block">@lang('roles.permissions')</label>                            
                    <table class="table table-bordered permissionTable mb-4">
                        <th>
                            @lang('roles.section')
                        </th>                            
                        <th>
                            <label>
                                <input class="grand_selectall" type="checkbox">
                                @lang('roles.select_all')
                            </label>
                        </th>                            
                        <th>
                            @lang('roles.available_permissions')
                        </th>                           
                
                        <tbody>
                        @foreach($permissions as $key => $group)
                            <tr class="py-8">
                                <td class="p-6">
                                    <b>{{ ucfirst($key) }}</b>
                                </td>
                                <td class="p-6">
                                    <label>
                                        <input class="selectall" type="checkbox">
                                        @lang('roles.select_all')
                                    </label>
                                </td>
                                <td class="p-6">                            
                                    @forelse($group as $permission)
                
                                    <label>
                                        <input name="permissions[]" class="permissioncheckbox" class="rounded-md border" type="checkbox" value="{{ $permission->id }}">
                                        {{$permission->name}} &nbsp;&nbsp;
                                    </label>                            
                                    @empty
                                        @lang('roles.no_permissions')
                                    @endforelse                            
                                </td>                            
                            </tr>
                        @endforeach
                        </tbody>
                    </table>                         
                    <button class="btn btn-primary" type="submit">@lang('roles.add_btn')</button>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- /row -->
    </div>
    <!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection

@push('scripts')
<script>
    $(".permissionTable").on('click', '.selectall', function () {

    if ($(this).is(':checked')) {
        $(this).closest('tr').find('[type=checkbox]').prop('checked', true);

    } else {
        $(this).closest('tr').find('[type=checkbox]').prop('checked', false);

    }

    calcu_allchkbox();

    });

    $(".permissionTable").on('click', '.grand_selectall', function () {
    if ($(this).is(':checked')) {
        $('.selectall').prop('checked', true);
        $('.permissioncheckbox').prop('checked', true);
    } else {
        $('.selectall').prop('checked', false);
        $('.permissioncheckbox').prop('checked', false);
    }
    });

    $(function () {

    calcu_allchkbox();
    selectall();

    });

    function selectall(){

    $('.selectall').each(function (i) {

        var allchecked = new Array();

        $(this).closest('tr').find('.permissioncheckbox').each(function (index) {
            if ($(this).is(":checked")) {
                allchecked.push(1);
            } else {
                allchecked.push(0);
            }
        });

        if ($.inArray(0, allchecked) != -1) {
            $(this).prop('checked', false);
        } else {
            $(this).prop('checked', true);
        }

    });
    }

    function calcu_allchkbox(){
    var allchecked = new Array();

    $('.selectall').each(function (i) {


        $(this).closest('tr').find('.permissioncheckbox').each(function (index) {
            if ($(this).is(":checked")) {
                allchecked.push(1);
            } else {
                allchecked.push(0);
            }
        });
    });

    if ($.inArray(0, allchecked) != -1) {
        $('.grand_selectall').prop('checked', false);
    } else {
        $('.grand_selectall').prop('checked', true);
    }
    }

    $('.permissionTable').on('click', '.permissioncheckbox', function () {

    var allchecked = new Array;

    $(this).closest('tr').find('.permissioncheckbox').each(function (index) {
        if ($(this).is(":checked")) {
            allchecked.push(1);
        } else {
            allchecked.push(0);
        }
    });

    if ($.inArray(0, allchecked) != -1) {
        $(this).closest('tr').find('.selectall').prop('checked', false);
    } else {
        $(this).closest('tr').find('.selectall').prop('checked', true);

    }

    calcu_allchkbox();

    });
</script>
@endpush