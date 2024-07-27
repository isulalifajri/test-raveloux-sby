<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="{{ asset('img/icons/icon-48x48.png') }}" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>Test Raveloux Sby</title>

	<link href="{{ asset('asset/css/app.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		
        @include('partials.sidebar')

		<div class="main">
			

            @include('partials.header')

			
			<main class="content">
				<div class="my-3">
					@if(Session::has('success'))
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<strong>{{ Session::get('success') }}</strong>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>    
					@endif
					@if(Session::has('success-danger'))
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<strong>{{ Session::get('success-danger') }}</strong>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>    
					@endif
					@if(Session::has('error'))
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<strong>{{ Session::get('error') }}</strong>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>    
					@endif
				</div>
				@yield('content')
			</main>

			<footer class="footer">
				@include('partials.footer')
			</footer>
		</div>
	</div>

	<script src="{{ asset('asset/js/app.js') }}"></script>

	@stack('js')

</body>

</html>