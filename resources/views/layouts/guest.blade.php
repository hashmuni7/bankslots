
<!doctype html>
<html lang="{{ app()->getLocale() }}" class="fixed">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Bank Slots | Log In</title>
        <link rel="icon" href="{{ URL::asset('img/salesmanagertitle.ico') }}"  type="image/x-icon" />

        <!-- Vendor CSS -->
		<link rel="stylesheet" href="{{ URL::asset('vendor/bootstrap/css/bootstrap.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('vendor/animate/animate.css') }}">

		<link rel="stylesheet" href="{{ URL::asset('vendor/font-awesome/css/all.min.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('vendor/magnific-popup/magnific-popup.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="{{ URL::asset('vendor/jquery-ui/jquery-ui.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('vendor/jquery-ui/jquery-ui.theme.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('vendor/bootstrap-multiselect/css/bootstrap-multiselect.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('vendor/morris/morris.css') }}" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{ URL::asset('css/theme.css') }}" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}">

		<!-- Head Libs -->
        <script src="{{ URL::asset('vendor/modernizr/modernizr.js') }}"></script>
       
    </head>
    <body>
        <!-- start: page -->
		{{ $slot }}
        <!-- end: page -->
        

        <!-- Vendor -->
        <script src="{{ URL::asset('vendor/jquery/jquery.js') }}"></script>
        <script src="{{ URL::asset('vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
        <script src="{{ URL::asset('vendor/jquery-cookie/jquery.cookie.js') }}"></script>
        <script src="{{ URL::asset('master/style-switcher/style.switcher.js') }}"></script>
        <script src="{{ URL::asset('vendor/popper/umd/popper.min.js') }}"></script>
        <script src="{{ URL::asset('vendor/bootstrap/js/bootstrap.js') }}"></script>
        <script src="{{ URL::asset('vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
        <script src="{{ URL::asset('vendor/common/common.js') }}"></script>
        <script src="{{ URL::asset('vendor/nanoscroller/nanoscroller.js') }}"></script>
        <script src="{{ URL::asset('vendor/magnific-popup/jquery.magnific-popup.js') }}"></script>
        <script src="{{ URL::asset('vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>
        
        
        <!-- Theme Base, Components and Settings -->
        <script src="{{ URL::asset('js/theme.js') }}"></script>
        
        <!-- Theme Custom -->
        <script src="{{ URL::asset('js/custom.js') }}"></script>
        
        <!-- Theme Initialization Files -->
        <script src="{{ URL::asset('js/theme.init.js') }}"></script>
        
    </body>
</html>




