<div class="mt-1">
    <label class="form-label" for="first_name">First Name</label>
    <div class="input-group input-group-merge">
        <input
        type="text"
        class="form-control @error('first_name') is-invalid @enderror"
        name="first_name"
        id="first_name"
        placeholder="input your first name" value="{{ old('first_name', $user->first_name) }}" />
    </div>
    @error('first_name')
      <div class="invalid-feedback d-block">
          {{ $message }}
      </div>
    @enderror
</div>


<div class="mt-1">
    <label class="form-label" for="last_name">Last Name</label>
    <div class="input-group input-group-merge">
        <input
        type="text"
        class="form-control @error('last_name') is-invalid @enderror"
        name="last_name"
        id="last_name"
        placeholder="input your last name" value="{{ old('last_name', $user->last_name)}}" />
    </div>
    @error('last_name')
      <div class="invalid-feedback d-block">
          {{ $message }}
      </div>
    @enderror
</div>

<div class="mt-1">
    <label for="email" class="form-label">Email:</label>
    <div class="input-group mb-3">
        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email', $user->email) }}">
        @error('email')
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

<div class="mt-1">
    <label class="form-label" for="phone_number">Phone Number</label>
    <div class="input-group input-group-merge">
        <input
        type="text"
        class="form-control @error('phone_number') is-invalid @enderror"
        name="phone_number"
        id="phone_number"
        placeholder="input your number phone" value="{{ old('phone_number', $user->phone_number) }}" />
    </div>
    @error('phone_number')
      <div class="invalid-feedback d-block">
          {{ $message }}
      </div>
    @enderror
</div>

<div class="mt-1">
    <label for="password" class="form-label">Password:</label>
    <div class="input-group mb-1">
        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" value="{{ old('password', $user->password) }}">
        @error('password')
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" onclick="myFunction()" id="defaultCheck1">
        <label class="form-check-label" for="defaultCheck1">
            Show Password
        </label>
    </div>
</div>


<div class="mt-1">
    <label class="form-label" for="my-editor">Address</label>
    <div class="input-group-merge">
        <textarea name="address" class="my-editor form-control @error('address') is-invalid @enderror" 
        id="my-editor" style="font-size:20px; resize:none">{{ old('address', $user->address) }}</textarea>
    </div>
    @error('address')
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mt-1">
    <label class="form-label" for="role">Role</label>
    @php
        $role = ['admin','user'];  
    @endphp
    <select class="form-select @error('role') is-invalid @enderror cursor-pointer jsn" name="role" id="role" required>
        <option value="">Select Role</option>
        @foreach ($role as $st)
            <option value="{{ $st }}" {{ old('role', $user->getRoleNames()->first()) == $st ? 'selected' : '' }}>{{ $st }}</option>
        @endforeach
    </select>
        @error('role')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
</div>

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


