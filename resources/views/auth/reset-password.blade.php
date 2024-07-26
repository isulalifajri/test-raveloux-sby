@extends('layouts.main')

@section('content')
    <div class="container-fluid p-0">

	
        <div class="row">
			<div class="col-md-12">
				<h1 class="h2">Page Update Password</h1>
				<div class="card p-3 mb-4">

					<div class="text-start mt-4">
						<p class="lead">				
                            Fill in this field, if you want to update your password
						</p>
					</div>

					<div class="card">
						<div class="card-body">
							<div class="m-sm-3">
								<form action="{{ route('password.update', request()->token) }}" method="POST">
									@csrf

                                    <div class="input-group mb-1">
                                        <input type="text" class="form-control" name="token" value="{{ request()->token }}" readonly>
                                        @error('token')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    </div>

                                    <label for="password" class="form-label">Email:</label>
                                    <div class="input-group mb-1">
                                        <input type="text" class="form-control" name="email" value="{{ request()->email }}" readonly>

                                        @error('email')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    </div>


									<label for="password" class="form-label">Password:</label>
                                    <div class="input-group mb-1">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" value="{{ old('password') }}">
                                        @error('password')
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <label class="form-label">Password Confirmation</label>
                                    <div class="input-group mb-1">
                                        <input type="password" class="form-control" name="password_confirmation" id="password">
                                    </div>

                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" onclick="myFunction()" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            Tampilkan Password
                                        </label>
                                    </div>
					
									<button type="submit" class="btn btn-primary">Update Password</button>
									
					
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

    </div>
@endsection

@push('js')
    <script>
        function myFunction() {
            var x = document.querySelectorAll("#password");
            for(var a=0; a < x.length ; a++){
                if (x[a].type === "password") {
                    x[a].type = "text";
                } else {
                    x[a].type = "password";
                }
            }
        }
    </script>
@endpush