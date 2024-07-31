@extends('layouts.main')

@section('content')
    <h3 class="my-3">Halaman Project Detail</h3>

    <!-- START DATA -->
    <div class="card bg-body shadow-sm">
        <div class="my-3 p-3 rounded">
            <h4>Detail Project</h4>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item d-flex row">
                        <dt class="col-sm-2">Title :</dt>
                        <dd class="col-sm-9">{{ $project->title }}</dd>
                    </li>
                    <li class="list-group-item d-flex row">
                        <dt class="col-sm-2">Description :</dt>
                        <dd class="col-sm-9">{{ $project->description }}</dd>
                    </li>
                    <li class="list-group-item d-flex row">
                        <dt class="col-sm-2">User Assigned :</dt>
                        <dd class="col-sm-9">{!! optional($project->user)->first_name ?? '<span class="text-danger">User tidak ada / User dihapus</span>' !!}</dd>
                    </li>
                    <li class="list-group-item d-flex row">
                        <dt class="col-sm-2">Client Assigned :</dt>
                        <dd class="col-sm-9">{!! optional($project->client)->contact_name ?? '<span class="text-danger">Client tidak ada / Client dihapus</span>' !!}</dd>
                    </li>
                    <li class="list-group-item d-flex row">
                        <dt class="col-sm-2">Status :</dt>
                        <dd class="col-sm-9"><span class="text-dark bg-info px-1 rounded">{{ $project->status }}</span></dd>
                    </li>
                    <li class="list-group-item d-flex row">
                        <dt class="col-sm-2">Deadline :</dt>
                        <dd class="col-sm-9"><span class="fw-bold">{{ $project->created_at }}</span></dd>
                    </li>
                  </ul>
            </div>
        </div>
    </div>
    <!-- END DATA -->

@endsection
