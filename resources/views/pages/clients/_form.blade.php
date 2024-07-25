<div class="mt-1">
    <label class="form-label" for="contact_name">Contact Name</label>
    <div class="input-group input-group-merge mb-3">
        <input
        type="text"
        class="form-control @error('contact_name') is-invalid @enderror"
        name="contact_name"
        id="contact_name"
        placeholder="input your first name" value="{{ old('contact_name', $client->contact_name) }}" />
    </div>
    @error('contact_name')
      <div class="invalid-feedback d-block">
          {{ $message }}
      </div>
    @enderror
</div>


<div class="mt-1">
    <label for="contact_email" class="form-label">Contact email:</label>
    <div class="input-group mb-3">
        <input type="email" class="form-control @error('contact_email') is-invalid @enderror" name="contact_email" id="contact_email" value="{{ old('contact_email', $client->contact_email) }}">
        @error('contact_email')
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

<div class="mt-1">
    <label class="form-label" for="contact_phone_number">Contact Phone Number</label>
    <div class="input-group input-group-merge mb-3">
        <input
        type="text"
        class="form-control @error('contact_phone_number') is-invalid @enderror"
        name="contact_phone_number"
        id="contact_phone_number"
        placeholder="input your number phone" value="{{ old('contact_phone_number', $client->contact_phone_number) }}" />
    </div>
    @error('contact_phone_number')
      <div class="invalid-feedback d-block">
          {{ $message }}
      </div>
    @enderror
</div>

<div class="mt-1">
    <label for="company_name" class="form-label">Company Name:</label>
    <div class="input-group mb-3">
        <input type="text" class="form-control @error('company_name') is-invalid @enderror" name="company_name" id="company_name" value="{{ old('company_name', $client->company_name) }}">
        @error('company_name')
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>


<div class="mt-1">
    <label class="form-label" for="my-editor">Company Address</label>
    <div class="input-group-merge mb-3">
        <textarea name="company_address" class="my-editor form-control @error('company_address') is-invalid @enderror" 
        id="my-editor" style="font-size:20px; resize:none">{{ old('company_address', $client->company_address) }}</textarea>
    </div>
    @error('company_address')
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mt-1">
    <label for="company_city" class="form-label">Company City:</label>
    <div class="input-group mb-3">
        <input type="text" class="form-control @error('company_city') is-invalid @enderror" name="company_city" id="company_city" value="{{ old('company_city', $client->company_city) }}">
        @error('company_city')
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

<div class="mt-1">
    <label for="company_zip" class="form-label">Company Zip:</label>
    <div class="input-group mb-3">
        <input type="text" class="form-control @error('company_zip') is-invalid @enderror" name="company_zip" id="company_zip" value="{{ old('company_zip', $client->company_zip) }}">
        @error('company_zip')
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

<div class="mt-1">
    <label for="company_vat" class="form-label">Company Vat:</label>
    <div class="input-group mb-3">
        <input type="text" class="form-control @error('company_vat') is-invalid @enderror" name="company_vat" id="company_vat" value="{{ old('company_vat', $client->company_vat) }}">
        @error('company_vat')
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>



