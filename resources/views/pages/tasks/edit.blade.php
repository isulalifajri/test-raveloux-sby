@extends('layouts.main')

@section('content')
    <div class="container-fluid p-0">

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                  <h5 class="card-header">Edit Form</h5>
                  <form method="POST" action="{{ route('update.tasks', $task->id) }}">
                    @method('PUT')
                    @csrf
                      <div class="card-body demo-vertical-spacing demo-only-element">
    
                          @include('pages.tasks._form')
      
                          <div class="mt-2">
                              <button type="submit" class="btn btn-primary"><i class="bx bx-save me-sm-1"></i> Save </button>
                              <a href="{{ url('/tasks') }}" class="btn btn-secondary" id="close">Close <i class="bx bx-x-circle me-sm-1" style="margin-left: 0.25rem"></i> </a>
                          </div>
                      </div>
                  </form>
                </div>
            </div>
        </div>

    </div>
@endsection