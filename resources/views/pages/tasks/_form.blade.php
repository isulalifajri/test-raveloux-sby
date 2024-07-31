@push('css')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

@endpush

<div class="mt-1">
    <label class="form-label" for="title">Title</label>
    <div class="input-group input-group-merge">
        <input
        type="text"
        class="form-control @error('title') is-invalid @enderror"
        name="title"
        id="title"
        placeholder="input your title" value="{{ old('title', $task->title) }}" />
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
        id="my-editor" style="font-size:20px; resize:none">{{ old('description', $task->description) }}</textarea>
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
        value="{{ old('deadline', $task->deadline) }}" required />
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
                @if(old('user_id', $task->user_id) == $user->id)
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
                @if(old('client_id', $task->client_id) == $client->id)
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
    <label class="form-label" for="project_id">Project</label>
      <select class="form-select @error('project_id') is-invalid @enderror cursor-pointer sl2" name="project_id" id="project_id" required>
            <option value="">Select Project</option>
            @foreach ($projects as $project)
                <option value="{{ $project->id }}" {{ old('project_id', $task->project_id) == $project->id ? 'selected' : '' }}>{{$project->title}}</option>
            @endforeach
        </select>
      @error('project_id')
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
            <option value="{{ $st }}" {{ old('status', $task->status) == $st ? 'selected' : '' }}>{{ $st }}</option>
        @endforeach
    </select>
        @error('status')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
</div>

@push('js')

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
    
@endpush
