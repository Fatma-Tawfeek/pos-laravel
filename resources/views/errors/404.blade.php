@extends('layouts.master2')

@section('title')
الصفحة غير موجودة	
@endsection

@section('css')
<!--- Internal Fontawesome css-->
<link href="{{URL::asset('assets/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
<!---Ionicons css-->
<link href="{{URL::asset('assets/plugins/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
<!---Internal Typicons css-->
<link href="{{URL::asset('assets/plugins/typicons.font/typicons.css')}}" rel="stylesheet">
<!---Internal Feather css-->
<link href="{{URL::asset('assets/plugins/feather/feather.css')}}" rel="stylesheet">
<!---Internal Falg-icons css-->
<link href="{{URL::asset('assets/plugins/flag-icon-css/css/flag-icon.min.css')}}" rel="stylesheet">
@endsection
@section('content')
		<!-- Main-error-wrapper -->
		<div class="main-error-wrapper  page page-h ">
			<img src="{{URL::asset('assets/img/media/404.png')}}" class="error-page" alt="error">
			<h2>الصفحة التي تبحث عنها غير موجودة.</h2>
			<h6>من الممكن انك اخطات في كتابة العنوان أو الصفحة التي تبحث عنها انتقلت الي عنوان آخر.</h6>
			<a class="btn btn-outline-danger" href="{{ route('home') }}">العودة الى الرئيسية</a>
		</div>
		<!-- /Main-error-wrapper -->
@endsection
@section('js')
@endsection