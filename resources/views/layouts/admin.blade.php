<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Munch Hub | @yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" type="image/png" href="{!! asset('public/img/fav.png') !!}"/>
  
  <!-- General CSS Files -->
	<link rel="stylesheet" href="{{URL::asset('public/backend/assets/css/app.min.css')}}">
	<link rel="stylesheet" href="{{URL::asset('public/backend/assets/bundles/summernote/summernote-bs4.css')}}">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{URL::asset('public/backend/assets/css/style.css')}}">
  <link rel="stylesheet" href="{{URL::asset('public/backend/assets/css/components.css')}}">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="{{URL::asset('public/backend/assets/css/custom.css')}}">
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
</head>      
<body>
	<div class="loader"></div>  
	<div id="app">    
		<div class="main-wrapper main-wrapper-1">
		
			@include('../Elements/Admin/header')
			<!-- Header Navbar: style can be found in header.less -->
		
			<!-- Left side column. contains the logo and sidebar -->
			 @include('../Elements/Admin/left-side-bar')
			<!-- /.content-wrapper -->
			  @yield('content')
			<!-- /.content-wrapper -->

			<!--Footer-->
			@include('../Elements/Admin/footer')

		</div>
	</div> 

<!-- COMMON SCRIPTS -->
		<script type="text/javascript">
			var site_url = "<?php echo URL::to('/'); ?>";
		</script>
<!-- General JS Scripts -->
  <script src="{{URL::asset('public/backend/assets/js/app.min.js')}}"></script>
  <script src="{{URL::asset('public/backend/assets/bundles/summernote/summernote-bs4.js')}}"></script>
  <!-- JS Libraies -->
  <script src="{{URL::asset('public/backend/assets/bundles/apexcharts/apexcharts.min.js')}}"></script>
  <!-- Page Specific JS File -->  
  <script src="{{URL::asset('public/backend/assets/js/page/index.js')}}"></script>
  <!-- Template JS File -->
  <script src="{{URL::asset('public/backend/assets/js/scripts.js')}}"></script>
  <!-- Custom JS File -->
  <script src="{{URL::asset('public/backend/assets/js/custom.js')}}"></script>
   <!-- Custom form Validation File -->
  <script src="{{URL::asset('public/js/custom-form-validation.js')}}"></script>
  <script src="{{URL::asset('public/js/custom.js')}}"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
@yield('scripts')
</body>
</html>