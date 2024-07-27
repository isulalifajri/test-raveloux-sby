
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

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />

	<title>Sign In | Test Raveloux</title>

	<link href="{{ asset('asset/css/app.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Welcome back!</h1>
							<p class="lead">
								Sign in to your account to continue
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-3">
									<form action="{{ route('authenticate') }}" method="POST">
										@csrf
										<label for="email" class="form-label">Email:</label>
										<div class="input-group mb-3">
											<span class="input-group-text" id="basic-addon1"><i data-feather="mail"></i></span>
											<input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email">
											@error('email')
												<div class="invalid-feedback d-block">
													{{ $message }}
												</div>
											@enderror
										</div>
						
										<label for="password" class="form-label">Password:</label>
										<div class="input-group mb-1">
											<span class="input-group-text" id="basic-addon1"><i data-feather="lock"></i></span>
											<input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
											@error('password')
												<div class="invalid-feedback d-block">
													{{ $message }}
												</div>
											@enderror
										</div>
										<div class="form-check mb-3">
											<input class="form-check-input" type="checkbox" onclick="myFunction()" id="defaultCheck1">
											<label class="form-check-label" for="defaultCheck1">
												Tampilkan Password
											</label>
										</div>
						
										<button type="submit" class="btn btn-primary">Login</button>
										
						
									</form>
								</div>
							</div>
						</div>
						<div class="text-center mb-3">
							Don't have an account? <a href="pages-sign-up.html">Sign up</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="{{ asset('asset/js/app.js') }}"></script>

    <script>
        function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
        }
    </script>
</body>

</html>