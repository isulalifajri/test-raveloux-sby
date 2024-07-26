@extends('layouts.main')

@section('content')
    <div class="container-fluid p-0">

	
        <div class="row">
			<div class="col-md-12">
				<h1 class="h2">Page Reset Password</h1>
				<div class="card p-3 mb-4">

					<div class="text-start mt-4">
						<p class="lead">
							Please input your email in this field, if you want to reset password
						</p>
					</div>

					<div class="card">
						<div class="card-body">
							<div class="m-sm-3">
								<form action="{{ route('password.email') }}" method="POST">
									@csrf
									<label for="email" class="form-label">Email:</label>
									<div class="input-group mb-3">
										<span class="input-group-text" id="basic-addon1"><i data-feather="mail"></i></span>
										<input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Input Your Email">
										@error('email')
											<div class="invalid-feedback d-block">
												{{ $message }}
											</div>
										@enderror
									</div>
					
									<button type="submit" class="btn btn-primary">Submit</button>
									
					
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

    </div>
@endsection