@if(request()->segment(count(request()->segments())) == 'edit') 
    <div class="mt-1">
        @if($project->hasMedia('images/projects'))
            @php
                $mediaItem = $project->getFirstMedia('images/projects');
            @endphp
            <div class="col-md-3">
                <img src="{{ $mediaItem->getUrl() }}" 
                class="img-preview img-fluid mb-3 d-block" 
                alt="{{ $mediaItem->name }}" 
                id="myImg">
            </div>
        @else
            <div class="col-md-3">
                <img src="{{ asset('no-image.jpg') }}" class="img-preview img-fluid img-circle" alt="default">
            </div>
        @endif
        <div class="input-group input-group-merge">
            <input
            type="file"
            accept="image/png, image/gif, image/jpeg, image/jpg, image/webp, image/avif"
            name="image"
            class="form-control @error('image') is-invalid @enderror"
            id="images-prv" onchange="previewImage()" />
        </div>
        <span style="font-size: 11px">*Only uploading image is allowed</span>
    </div>   
@endif

<div class="mt-1">
    <label class="form-label" for="title">Title</label>
    <div class="input-group input-group-merge">
        <input
        type="text"
        class="form-control @error('title') is-invalid @enderror"
        name="title"
        id="title"
        placeholder="input your title" value="{{ old('title', $project->title) }}" />
    </div>
    @error('title')
      <div class="invalid-feedback d-block">
          {{ $message }}
      </div>
    @enderror
</div>

<div class="mt-1">
    <label class="form-label" for="my-editor">Description</label>
    <div class="input-group-merge">
        <textarea name="description" class="my-editor form-control @error('description') is-invalid @enderror" 
        id="my-editor" style="font-size:20px; resize:none">{{ old('description', $project->description) }}</textarea>
    </div>
    @error('description')
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mt-1">
    <label class="form-label" for="deadline">Deadline</label>
    <div class="input-group input-group-merge">
        <input
        type="text"
        class="form-control datepicker @error('deadline') is-invalid @enderror"
        name="deadline"
        id="deadline" placeholder="yyyy-mm-dd" onfocus="(this.type='date')"
        value="{{ old('deadline', $project->deadline) }}" required />
    </div>
    @error('deadline')
      <div class="invalid-feedback d-block">
          {{ $message }}
      </div>
    @enderror
</div>

<div class="mt-1">
    <label class="form-label" for="user_id">User</label>
      <select class="form-select @error('user_id') is-invalid @enderror cursor-pointer" name="user_id" id="user_id" required>
            <option value="">Select User</option>
            @foreach ($users as $user)
                @if(old('user_id', $project->user_id) == $user->id)
                    <option value="{{ $user->id }}" selected>{{$user->first_name}}</option>
                @else 
                    <option value="{{ $user->id }}">{{$user->first_name}}</option>
                @endif
            @endforeach
      </select>
      @error('user_id')
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
      @enderror
</div>

<div class="mt-1">
    <label class="form-label" for="client_id">Client</label>
      <select class="form-select @error('client_id') is-invalid @enderror cursor-pointer" name="client_id" id="client_id" required>
            <option value="">Select client</option>
            @foreach ($clients as $client)
                @if(old('client_id', $project->client_id) == $client->id)
                    <option value="{{ $client->id }}" selected>{{$client->contact_name}}</option>
                @else 
                    <option value="{{ $client->id }}">{{$client->contact_name}}</option>
                @endif
            @endforeach
      </select>
      @error('client_id')
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
      @enderror
</div>


<div class="mt-1">
    <label class="form-label" for="status">Status</label>
    @php
        $status = ['open', 'close','done','in progress'];  
    @endphp
    <select class="form-select @error('status') is-invalid @enderror cursor-pointer jsn" name="status" id="status" required>
        <option value="">Select Status</option>
        @foreach ($status as $st)
            <option value="{{ $st }}" {{ old('status', $project->status) == $st ? 'selected' : '' }}>{{ $st }}</option>
        @endforeach
    </select>
        @error('status')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
</div>

@if(request()->segment(count(request()->segments())) == 'create')    
    <div class="mt-1">
        <label class="form-label" for="image-prv">Image</label>
        <img class="img-preview img-fluid mb-3 col-sm-2" alt="">
        <div class="input-group input-group-merge">
            <input
            type="file"
            accept="image/png, image/gif, image/jpeg, image/jpg, image/webp, image/avif"
            name="image"
            class="form-control @error('image') is-invalid @enderror"
            id="images-prv" onchange="previewImage()" required />
        </div>
        <span style="font-size: 11px">*Only uploading image is allowed</span>
    </div>
@endif

@push('js')

    <script>
        function previewImage(){
        const image =  document.querySelector('#images-prv');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const blob = URL.createObjectURL(image.files[0]);
            imgPreview.src = blob;
        }
    </script>
@endpush