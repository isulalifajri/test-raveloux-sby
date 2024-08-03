@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    {{-- link css datepicker bootstrap --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <style>
        .datepicker{
            width: 285px;
        }
        .datepicker table{
            width: 100%;
        }
        .datepicker tfoot tr th {
            background: #eee;
        }
    </style>
@endpush

<div class="mt-1">
    @if($project->hasMedia('images/projects'))
        @php
            $mediaItems = $project->getMedia('images/projects');
        @endphp
        <div class="d-flex flex-wrap gap-1 mb-2">
            @foreach ($mediaItems as $mediaItem)
                <div class="col-md-3 d-flex justify-content-center align-items-center border rounded p-2 position-relative">
                    <img src="{{ $mediaItem->getUrl() }}" 
                        class="img-fluid rounded jml-gambar" 
                        alt="{{ $mediaItem->name }}" 
                        id="myImg">

                    <!-- Link untuk Menghapus Gambar -->
                    <a href="{{ route('projects.image.destroy', [$project->id, $mediaItem->id]) }}" 
                        class="btn btn-danger p-1 position-absolute top-0 end-0 m-1"
                        aria-label="Remove image">
                        <span data-feather="trash-2"></span>
                    </a>

                </div>
            @endforeach
        </div>
    
    @else
        <div class="col-md-3">
            <img src="{{ asset('no-image.jpg') }}" class="img-preview img-fluid img-circle" alt="default">
        </div>
    @endif
    
    <div id="image-previews" class="d-flex flex-wrap gap-2 mt-3">
        <!-- Image previews will be inserted here -->
    </div>

    @if ($project->getMedia('images/projects')->count() < 8)
        <div id="input-container">
            <div class="input-group input-group-merge mb-3" id="input-group" data-index="0">
                <input
                    type="file"
                    accept="image/png, image/gif, image/jpeg, image/jpg, image/webp, image/avif"
                    name="images[]"
                    class="form-control @error('images.*') is-invalid @enderror"
                    id="images-prv-0"
                    multiple
                    onchange="previewImages(event, 0)" />
            </div>
            @error('images.*')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
    @endif
    <span style="font-size: 11px">*Only uploading images is allowed (max 8 images per input)</span>
    <div class="d-block">
        <button type="button" class="btn btn-secondary" onclick="addInputField()">Add More Images</button>
    </div>
</div>   

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
        id="deadline" placeholder="yyyy-mm-dd"
        value="{{ old('deadline', $project->deadline) }}" required />
        <span class="input-group-text" id="cldr-icon"><i data-feather="calendar"></i></span>
    </div>
    @error('deadline')
      <div class="invalid-feedback d-block">
          {{ $message }}
      </div>
    @enderror
</div>

<div class="mt-1">
    <label class="form-label" for="user_id">User</label>
      <select class="form-select @error('user_id') is-invalid @enderror cursor-pointer sl2" name="user_id" id="user_id" required>
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
      <select class="form-select @error('client_id') is-invalid @enderror cursor-pointer sl2" name="client_id" id="client_id" required>
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
    <select class="form-select @error('status') is-invalid @enderror cursor-pointer sl2" name="status" id="status" required>
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

@push('js')
<script>
    let currentPreviewCount = 0; // Jumlah gambar yang telah ditampilkan
    let inputCount = 0; // Jumlah field input yang ada saat ini

    // Inisialisasi input field dan gambar pratinjau saat halaman dimuat
    document.addEventListener('DOMContentLoaded', () => {
        const existingInputs = document.querySelectorAll('#input-container input[type="file"]');
        existingInputs.forEach((input, index) => {
            input.dataset.index = index;
            inputCount = index + 1; // Update inputCount ke indeks tertinggi
        });

        // Hitung gambar pratinjau yang sudah ada
        const existingImages = document.querySelectorAll('.jml-gambar');
        currentPreviewCount = existingImages.length;

        console.log('Jumlah input field awal:', inputCount);
        console.log('Jumlah gambar pratinjau awal:', currentPreviewCount);
        console.log('total:', currentPreviewCount + inputCount);
    });

    function updateInputFieldLimit() {
        // Hitung jumlah input field
        const inputFields = document.querySelectorAll('#input-container input[type="file"]').length;

        // Hitung jumlah gambar pratinjau
        const imagePreviews = document.querySelectorAll('.jml-gambar').length;

        console.log(`Jumlah input field: ${inputFields}`);
        console.log(`Jumlah gambar pratinjau: ${imagePreviews}`);

        return inputFields + imagePreviews;
    }

    function previewImages(event, index) {
        const input = event.target;
        const previewContainer = document.getElementById('image-previews');
        const files = input.files;

        const totalImages = updateInputFieldLimit();

        if (totalImages > 8) {
            alert('Anda dapat mengupload maksimal 8 gambar.');
            return;
        }

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();

            reader.onload = function (e) {
                const container = document.createElement('div');
                container.className = 'img-container position-relative mb-3 col-sm-2';
                container.dataset.inputIndex = input.dataset.index; // Simpan indeks input
                container.dataset.fileIndex = i; // Simpan indeks file

                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = `img-preview img-preview-${index}-${i + 1} img-fluid border`; //
                img.alt = `Pratinjau gambar ${index}-${i + 1}`;

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

         // Add disabled attribute to input
        // input.setAttribute('disabled', true); -> jangan disabled soalnya filenya nggak kebaca ternyata
        input.setAttribute('readonly', true);

        const inputWrapper = input.closest('.input-group');
        if (inputWrapper) {
            const removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.className = 'btn btn-danger btn-sm';
            removeButton.textContent = 'X';
            removeButton.onclick = function() {
                console.log('Menghapus input dengan data-index:', input.dataset.index);
                removeInputField(inputWrapper, input.dataset.index); // Hapus field input
            };

            inputWrapper.appendChild(removeButton);
        }

        // Update currentPreviewCount
        currentPreviewCount += files.length;

        console.log('Jumlah input field setelah menambahkan pratinjau:', inputCount);
        console.log('Jumlah gambar pratinjau setelah menambahkan:', currentPreviewCount);
    }

    function addInputField() {
        const inputContainer = document.getElementById('input-container');

        // Hitung total gambar (pratinjau + field input)
        const totalImages = updateInputFieldLimit();

        if (totalImages >= 8) {
            alert('Anda dapat mengupload maksimal 8 gambar.');
            return;
        }

        // Buat input field baru
        const inputWrapper = document.createElement('div');
        inputWrapper.className = 'input-group input-group-merge mb-3';
        inputWrapper.dataset.index = inputCount; // Tambahkan atribut data-index

        const newInput = document.createElement('input');
        newInput.type = 'file';
        newInput.accept = 'image/png, image/gif, image/jpeg, image/jpg, image/webp, image/avif';
        newInput.name = 'images[]';
        newInput.className = 'form-control';
        newInput.id = `images-prv-${inputCount}`;
        newInput.multiple = true;
        newInput.dataset.index = inputCount; // Tambahkan atribut data-index
        newInput.onchange = function(event) { previewImages(event, inputCount); };

        inputWrapper.appendChild(newInput);
        inputContainer.appendChild(inputWrapper);

        inputCount++;

        console.log('Jumlah field input setelah menambahkan yang baru:', inputCount);
    }

    function removeImage(container, file, index) {
        console.log('Menghapus gambar dengan data-input-index:', container.dataset.inputIndex);

        // Hapus kontainer pratinjau gambar
        container.remove();

        // Update field input
        const inputs = Array.from(document.querySelectorAll('#input-container input'));
        inputs.forEach(input => {
            if (input.dataset.index == index) {
                const files = Array.from(input.files).filter(f => f !== file);
                const dataTransfer = new DataTransfer();
                files.forEach(f => dataTransfer.items.add(f));
                input.files = dataTransfer.files;

                // Hapus field input jika tidak ada file tersisa
                if (files.length === 0) {
                    const inputWrapper = input.closest('.input-group');
                    if (inputWrapper) {
                        inputWrapper.remove();
                    }
                }
            }
        });

        // Hapus field input dengan data-input-index yang sesuai
        const inputWrapperToRemove = Array.from(document.querySelectorAll('#input-container .input-group')).find(wrapper => {
            return wrapper.dataset.index == container.dataset.inputIndex;
        });

        if (inputWrapperToRemove) {
            console.log('Menghapus field input dengan data-index:', container.dataset.inputIndex);
            inputWrapperToRemove.remove();
        }

        // Update currentPreviewCount
        const remainingPreviews = document.querySelectorAll('#image-previews .img-container');
        currentPreviewCount = remainingPreviews.length;

        console.log('Jumlah gambar pratinjau setelah menghapus:', currentPreviewCount);
    }

    function removeInputField(wrapper, index) {
        const input = wrapper.querySelector('input[type="file"]');
        if (input) {
            input.value = '';
            wrapper.remove();
        }

        // Hapus pratinjau gambar yang terkait
        const previews = document.querySelectorAll(`#image-previews .img-container[data-input-index="${index}"]`);
        previews.forEach(preview => preview.remove());

        // Update currentPreviewCount
        const remainingPreviews = document.querySelectorAll('#image-previews .img-container');
        currentPreviewCount = remainingPreviews.length;

        console.log('Jumlah gambar pratinjau setelah menghapus input:', currentPreviewCount);
    }
</script>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.sl2').select2({
            theme: "bootstrap-5",
            selectionCssClass: "select2--medium",
            dropdownCssClass: "select2--medium",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        });
    });
</script>

{{-- datepicker bootstrap --}}
<script src= "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"> </script> 
<script> 
    document.getElementById('cldr-icon').addEventListener('click', function() {
            document.getElementById('deadline').focus();
        });
    $(function () { 
        $(".datepicker").datepicker({  
            format:'yyyy-mm-dd',
            autoclose: true,  
            todayHighlight: true, 
            todayBtn : "linked", 
        }); 
    }); 
</script>

@endpush



















