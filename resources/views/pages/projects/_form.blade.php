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