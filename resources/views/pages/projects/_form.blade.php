
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
        type="date"
        class="form-control datepicker @error('deadline') is-invalid @enderror"
        name="deadline"
        id="deadline" placeholder="yyyy-mm-dd"
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

{{-- @if(request()->segment(count(request()->segments())) == 'create')    
    <div class="mt-1">
        <label class="form-label" for="image-prv">Image</label>
        <img class="img-preview img-fluid mb-3 col-sm-2" alt="">
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
@endif --}}

@if(request()->segment(count(request()->segments())) == 'create')
    <div class="mt-1">
        <label class="form-label" for="images-prv-0">Images</label>
        <div id="image-previews" class="d-flex flex-wrap gap-2 mt-3">
            <!-- Image previews will be inserted here -->
        </div>
        <div id="input-container">
            <div class="input-group input-group-merge mb-3" data-index="0">
                <input
                    type="file"
                    accept="image/png, image/gif, image/jpeg, image/jpg, image/webp, image/avif"
                    name="images[]"
                    class="form-control @error('images.*') is-invalid @enderror"
                    id="images-prv-0"
                    multiple
                    onchange="previewImages(event, 0)" />
            </div>
        </div>
        <span style="font-size: 11px">*Only uploading images is allowed (max 3 images per input)</span>
        <div class="d-block">
            <button type="button" class="btn btn-secondary" onclick="addInputField()">Add More Images</button>
        </div>
    </div>
@endif



{{-- @push('js')

    <script>
        function previewImage(){
        const image =  document.querySelector('#images-prv');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const blob = URL.createObjectURL(image.files[0]);
            imgPreview.src = blob;
        }
    </script>
@endpush --}}

{{-- @push('js')
<script>
    let currentPreviewCount = 0;
    let inputCount = 0; // Mulai dari 0 dan tambahkan secara dinamis

    // Menambahkan data-index ke semua input yang ada saat halaman dimuat
    document.addEventListener('DOMContentLoaded', () => {
        const existingInputs = document.querySelectorAll('#input-container input[type="file"]');
        existingInputs.forEach((input, index) => {
            input.dataset.index = index;
            inputCount = index + 1; // Update inputCount ke nilai maksimum yang ada
        });
    });

    function previewImages(event, index) {
        const input = event.target;
        const previewContainer = document.getElementById('image-previews');
        const files = input.files;

        if (files.length > 3) {
            alert('You can upload a maximum of 3 images per input.');
            input.value = ''; // Clear the input
            return;
        }

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();

            reader.onload = function (e) {
                const container = document.createElement('div');
                container.className = 'img-container position-relative mb-3 col-sm-2';
                container.dataset.inputIndex = input.dataset.index; // Get data-index from the input element
                container.dataset.fileIndex = i; // Track which file index the image is from

                const img = document.createElement('img');
                img.src = e.target.result;
                
                img.className = `img-preview img-preview-${index}-${i + 1} img-fluid border`;
                img.alt = `Image preview ${index}-${i + 1}`;

                const deleteButton = document.createElement('button');
                deleteButton.type = 'button';
                deleteButton.className = 'btn btn-danger btn-sm position-absolute top-0 end-0 m-1';
                deleteButton.innerHTML = 'X';
                deleteButton.onclick = function() { removeImage(container, file, index); };

                container.appendChild(img);
                container.appendChild(deleteButton);
                previewContainer.appendChild(container);
            };

            reader.readAsDataURL(file);
        }

        // Add readonly attribute to input
        input.setAttribute('readonly', true);

        // Add remove button to input
        const inputWrapper = input.closest('.input-group');
        if (inputWrapper) {
            const removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.className = 'btn btn-danger btn-sm';
            removeButton.textContent = 'X';
            removeButton.onclick = function() {
                console.log('Removing input with data-index:', input.dataset.index);
                removeInputField(inputWrapper, input.dataset.index); // Pass data-index to the function
            };

            inputWrapper.appendChild(removeButton);
        }

        // Update currentPreviewCount
        currentPreviewCount += files.length;
    }

    function addInputField() {
        if (currentPreviewCount >= 3) {
            alert('You can upload a maximum of 3 images in total.');
            return;
        }

        const inputContainer = document.getElementById('input-container');

        // Create a new div to wrap around the input field
        const inputWrapper = document.createElement('div');
        inputWrapper.className = 'input-group input-group-merge mb-3';
        inputWrapper.dataset.index = inputCount; // Add data-index attribute to the wrapper

        // Create the new file input
        const newInput = document.createElement('input');
        newInput.type = 'file';
        newInput.accept = 'image/png, image/gif, image/jpeg, image/jpg, image/webp, image/avif';
        newInput.name = 'images[]';
        newInput.className = 'form-control';
        newInput.id = `images-prv-${inputCount}`;
        newInput.multiple = true;
        newInput.dataset.index = inputCount; // Add data-index attribute
        newInput.onchange = function(event) { previewImages(event, inputCount); };

        // Add input to the wrapper
        inputWrapper.appendChild(newInput);

        // Add the wrapper to the container
        inputContainer.appendChild(inputWrapper);

        inputCount++;
    }

    function removeImage(container, file, index) {
        // Display the data-input-index value
        console.log('Removing image with data-input-index:', container.dataset.inputIndex);

        // Remove the image preview container
        container.remove();

        // Find and clear the file input that corresponds to this image
        const inputs = Array.from(document.querySelectorAll('#input-container input'));
        inputs.forEach(input => {
            if (input.dataset.index == index) {
                const files = Array.from(input.files).filter(f => f !== file);
                const dataTransfer = new DataTransfer();
                files.forEach(f => dataTransfer.items.add(f));
                input.files = dataTransfer.files;

                // If all images from the input are removed, remove the input field and its wrapper
                if (files.length === 0) {
                    const inputWrapper = input.closest('.input-group');
                    if (inputWrapper) {
                        inputWrapper.remove();
                    }
                }
            }
        });

        // Find and remove the input field with the matching data-input-index
        const inputWrapperToRemove = Array.from(document.querySelectorAll('#input-container .input-group')).find(wrapper => {
            return wrapper.dataset.index == container.dataset.inputIndex;
        });

        if (inputWrapperToRemove) {
            console.log('Removing input field with data-index:', container.dataset.inputIndex);
            inputWrapperToRemove.remove();
        }

        // Adjust currentPreviewCount if needed
        currentPreviewCount -= 1;
    }



    function removeInputField(wrapper, index) {
        const input = wrapper.querySelector('input[type="file"]');
        if (input) {
            // Clear all files from the input
            input.value = '';

            // Remove the input wrapper
            wrapper.remove();
        }

        // Remove all associated image previews
        const previews = document.querySelectorAll(`#image-previews .img-container[data-input-index="${index}"]`);
        previews.forEach(preview => preview.remove());

        // Adjust currentPreviewCount if needed
        const remainingPreviews = document.querySelectorAll('#image-previews .img-container');
        currentPreviewCount = remainingPreviews.length;
    }
</script>
@endpush --}}

@push('js')
<script>
    let currentPreviewCount = 0;
    let inputCount = 0; // Mulai dari 0 dan tambahkan secara dinamis

    // Menambahkan data-index ke semua input yang ada saat halaman dimuat
    document.addEventListener('DOMContentLoaded', () => {
        const existingInputs = document.querySelectorAll('#input-container input[type="file"]');
        existingInputs.forEach((input, index) => {
            input.dataset.index = index;
            inputCount = index + 1; // Update inputCount ke nilai maksimum yang ada
            // Update currentPreviewCount berdasarkan jumlah file yang ada
            currentPreviewCount += Array.from(input.files).length;
        });
    });

    function previewImages(event, index) {
        const input = event.target;
        const previewContainer = document.getElementById('image-previews');
        const files = input.files;

        if (currentPreviewCount + files.length > 3) {
            alert('You can upload a maximum of 3 images in total.');
            input.value = ''; // Clear the input
            return;
        }

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();

            reader.onload = function (e) {
                const container = document.createElement('div');
                container.className = 'img-container position-relative mb-3 col-sm-2';
                container.dataset.inputIndex = input.dataset.index; // Get data-index from the input element
                container.dataset.fileIndex = i; // Track which file index the image is from

                const img = document.createElement('img');
                img.src = e.target.result;
                
                img.className = `img-preview img-preview-${index}-${i + 1} img-fluid border`;
                img.alt = `Image preview ${index}-${i + 1}`;

                const deleteButton = document.createElement('button');
                deleteButton.type = 'button';
                deleteButton.className = 'btn btn-danger btn-sm position-absolute top-0 end-0 m-1';
                deleteButton.innerHTML = 'X';
                deleteButton.onclick = function() { removeImage(container, file, index); };

                container.appendChild(img);
                container.appendChild(deleteButton);
                previewContainer.appendChild(container);
            };

            reader.readAsDataURL(file);
        }

        // Add readonly attribute to input
        input.setAttribute('readonly', true);

        // Add remove button to input
        const inputWrapper = input.closest('.input-group');
        if (inputWrapper) {
            const removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.className = 'btn btn-danger btn-sm';
            removeButton.textContent = 'X';
            removeButton.onclick = function() {
                console.log('Removing input with data-index:', input.dataset.index);
                removeInputField(inputWrapper, input.dataset.index); // Pass data-index to the function
            };

            inputWrapper.appendChild(removeButton);
        }

        // Update currentPreviewCount
        currentPreviewCount += files.length;
    }

    function addInputField() {
        if (currentPreviewCount >= 3) {
            alert('You can upload a maximum of 3 images in total.');
            return;
        }

        const inputContainer = document.getElementById('input-container');

        // Create a new div to wrap around the input field
        const inputWrapper = document.createElement('div');
        inputWrapper.className = 'input-group input-group-merge mb-3';
        inputWrapper.dataset.index = inputCount; // Add data-index attribute to the wrapper

        // Create the new file input
        const newInput = document.createElement('input');
        newInput.type = 'file';
        newInput.accept = 'image/png, image/gif, image/jpeg, image/jpg, image/webp, image/avif';
        newInput.name = 'images[]';
        newInput.className = 'form-control';
        newInput.id = `images-prv-${inputCount}`;
        newInput.multiple = true;
        newInput.dataset.index = inputCount; // Add data-index attribute
        newInput.onchange = function(event) { previewImages(event, inputCount); };

        // Add input to the wrapper
        inputWrapper.appendChild(newInput);

        // Add the wrapper to the container
        inputContainer.appendChild(inputWrapper);

        inputCount++;
    }

    function removeImage(container, file, index) {
        // Display the data-input-index value
        console.log('Removing image with data-input-index:', container.dataset.inputIndex);

        // Remove the image preview container
        container.remove();

        // Find and clear the file input that corresponds to this image
        const inputs = Array.from(document.querySelectorAll('#input-container input'));
        inputs.forEach(input => {
            if (input.dataset.index == index) {
                const files = Array.from(input.files).filter(f => f !== file);
                const dataTransfer = new DataTransfer();
                files.forEach(f => dataTransfer.items.add(f));
                input.files = dataTransfer.files;

                // If all images from the input are removed, remove the input field and its wrapper
                if (files.length === 0) {
                    const inputWrapper = input.closest('.input-group');
                    if (inputWrapper) {
                        inputWrapper.remove();
                    }
                }
            }
        });

        // Find and remove the input field with the matching data-input-index
        const inputWrapperToRemove = Array.from(document.querySelectorAll('#input-container .input-group')).find(wrapper => {
            return wrapper.dataset.index == container.dataset.inputIndex;
        });

        if (inputWrapperToRemove) {
            console.log('Removing input field with data-index:', container.dataset.inputIndex);
            inputWrapperToRemove.remove();
        }

        // Adjust currentPreviewCount if needed
        const remainingPreviews = document.querySelectorAll('#image-previews .img-container');
        currentPreviewCount = remainingPreviews.length;
    }

    function removeInputField(wrapper, index) {
        const input = wrapper.querySelector('input[type="file"]');
        if (input) {
            // Clear all files from the input
            input.value = '';

            // Remove the input wrapper
            wrapper.remove();
        }

        // Remove all associated image previews
        const previews = document.querySelectorAll(`#image-previews .img-container[data-input-index="${index}"]`);
        previews.forEach(preview => preview.remove());

        // Adjust currentPreviewCount if needed
        const remainingPreviews = document.querySelectorAll('#image-previews .img-container');
        currentPreviewCount = remainingPreviews.length;
    }
</script>
@endpush
















