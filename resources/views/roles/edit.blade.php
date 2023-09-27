@extends('layouts.master')

@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Forms</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Form-Validation</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection

@section('content')
        <!-- row -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        
                            <form action="{{route('roles.update', $role->id )}}" method="POST">
                                @csrf         
                                @method('PUT')                   
                                <h1 class="text-3xl mt-4 mb-8"> Create Role </h1>
                            
                                <div class="mb-6">
                                    <label for="name" class="block">Role Name:</label>
                                    <input type="text" value="{{ $role->name }}" name="name" id="name" class="form-control" placeholder="User, Editor, Author ... " >
                                    
                                    @foreach ($errors->get('name') as $error)
                                        <p class="text-red-600">{{$error}}</p>
                                    @endforeach
                                </div>

                                <label for="name" class="block mt-4">Permissions:</label>                            
                                <table class="table table-bordered permissionTable mb-4">
                                    <th>
                                        {{__('Section')}}
                                    </th>                            
                                    <th>
                                        <label>
                                            <input class="grand_selectall" type="checkbox">
                                            {{__('Select All') }}
                                        </label>
                                    </th>                            
                                    <th>
                                        {{__("Available permissions")}}
                                    </th>                           
                            
                                    <tbody>
                                    @foreach($permissions as $key => $group)
                                        <tr class="py-8">
                                            <td class="p-6">
                                                <b>{{ ucfirst($key) }}</b>
                                            </td>
                                            <td class="p-6" width="30%">
                                                <label>
                                                    <input class="selectall" type="checkbox">
                                                    {{__('Select All') }}
                                                </label>
                                            </td>
                                            <td class="p-6">                            
                                                @forelse($group as $permission)
                            
                                                <label style="width: 30%" class="">
                                                    <input name="permissions[]" class="permissioncheckbox" class="rounded-md border" type="checkbox" value="{{ $permission->id }}" {{ $role->permissions->contains('id',$permission->id) ? "checked" : "" }}>
                                                    {{$permission->name}} &nbsp;&nbsp;
                                                </label>                            
                                                @empty
                                                    {{ __("No permission in this group !") }}
                                                @endforelse                            
                                            </td>                            
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>             
                            
                                <button class="btn btn-primary" type="submit">Submit form</button>
                            
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