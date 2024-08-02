@extends('layouts.main')

@push('css')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

@endpush

@section('content')
    <div class="container-fluid p-0">

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                  <h5 class="card-header">Manage Permission Form</h5>
                  <form method="POST" action="{{ route('managementUsers.update', $user->id) }}">
                    @method('PUT')
                    @csrf
                      <div class="card-body demo-vertical-spacing demo-only-element">
    
                            <div class="mt-1">
                                <label class="form-label" for="user">User</label>
                                <div class="input-group input-group-merge">
                                    <input
                                    type="text"
                                    class="form-control @error('user') is-invalid @enderror"
                                    name="user"
                                    id="user"
                                    placeholder="input your user" value="{{ old('user', $user->first_name) }}" readonly />
                                </div>
                            </div>

                            <div class="mt-1">
                                <label class="form-label" for="role">Role</label>
                                <div class="input-group input-group-merge">
                                    <input
                                    type="text"
                                    class="form-control"
                                    name="role"
                                    id="role"
                                    value="{{ $user->getRoleNames()->first() }}" readonly />
                                </div>
                            </div>

                            <div class="mt-1">
                                <label for="permission" class="form-label">Permissions</label>
                                <select class="form-select" id="permission" name="permission[]" multiple>
                                    @foreach($allPermissions as $permission)
                                    <option value="{{ $permission->name }}" @if($user->permissions->contains($permission->id)) selected @endif>
                                        {{ $permission->name }}
                                    </option>
                                    
                                    @endforeach
                                </select>
                                
                                @error('permission')
                                  <div class="invalid-feedback d-block">
                                      {{ $message }}
                                  </div>
                                @enderror
                            </div>

      
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary"><i class="bx bx-save me-sm-1"></i> Save Changes </button>
                                <a href="{{ url('/managementUsers') }}" class="btn btn-secondary" id="close">Close <i class="bx bx-x-circle me-sm-1" style="margin-left: 0.25rem"></i> </a>
                            </div>
                      </div>
                  </form>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('js')

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $( '#permission' ).select2( {
        theme: "bootstrap-5",
        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        closeOnSelect: false,
    } );
</script>
    
@endpush