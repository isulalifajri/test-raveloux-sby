@extends('layouts.main')

@section('content')
  <div class="row">
    <div class="col-md-3">

      <!-- Profile Image -->
      <div class="card card-primary card-outline mb-3">
        <div class="card-body box-profile">
          <div class="text-center">
            <img src="{{ asset('no-image.jpg') }}"  class="profile-user-img img-fluid img-circle" style="height: 80px; width:80px" alt="default">
          </div>

          <h3 class="text-center p-0">{{ auth()->user()->first_name }}</h3>
          <p class="text-muted small text-center">{{ auth()->user()->getRoleNames()->first() }}</p>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="card">
        <div class="card-body">
          <div class="tab-pane1">
            <form  class="form-horizontal" action="{{ route('profiles.update', $data->id) }}" method="POST">
              @method('PUT')
              @csrf
              <div class="form-group">
                <div class="mb-3 row">
                  <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name', $data->first_name) }}" name="first_name" id="first_name">
                    @error('first_name')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="mb-3 row">
                  <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name', $data->last_name) }}" name="last_name" id="last_name">
                    @error('last_name')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
              </div>
  
              <div class="form-group">
                
                  <div class="mb-3 row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $data->email) }}" name="email" id="email">
                      @error('email')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
              </div>
              <div class="form-group">
                
                  <div class="mb-3 row">
                    <label for="phone_number" class="col-sm-2 col-form-label">Telepon</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number', $data->phone_number) }}" name="phone_number" id="phone_number">
                      @error('phone_number')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
              </div>
              <div class="form-group">
                
                  <div class="mb-3 row">
                    <label for="address" class="col-sm-2 col-form-label">address</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" name="address" id="address" cols="10" rows="3">{{ $data->address }}</textarea>
                     
                      @error('address')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
              </div>
  
              <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn btn-success"><i class="fas fa-save me-1"></i>Save Changes</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
        <!-- /.card -->

      
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
@endsection