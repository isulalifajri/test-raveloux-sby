@extends('layouts.main')

@section('content')
    <h3 class="my-3">Halaman Task Detail</h3>

    <!-- START DATA -->
    <div class="card bg-body shadow-sm">
        <div class="my-3 p-3 rounded">
            <h4>Detail Task</h4>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item d-flex row">
                        <dt class="col-sm-2">Title :</dt>
                        <dd class="col-sm-9">{{ $task->title }}</dd>
                    </li>
                    <li class="list-group-item d-flex row">
                        <dt class="col-sm-2">Description :</dt>
                        <dd class="col-sm-9">{{ $task->description }}</dd>
                    </li>
                    <li class="list-group-item d-flex row">
                        <dt class="col-sm-2">User Assigned :</dt>
                        <dd class="col-sm-9">{!! optional($task->user)->first_name ?? '<span class="text-danger">User tidak ada / User dihapus</span>' !!}</dd>
                    </li>
                    <li class="list-group-item d-flex row">
                        <dt class="col-sm-2">Client Assigned :</dt>
                        <dd class="col-sm-9">{!! optional($task->client)->contact_name ?? '<span class="text-danger">Client tidak ada / Client dihapus</span>' !!}</dd>
                    </li>
                    <li class="list-group-item d-flex row">
                        <dt class="col-sm-2">Project :</dt>
                        <dd class="col-sm-9">{!! optional($item->project)->title ?? '<span class="text-danger">Project tidak ada / Project dihapus</span>' !!}</dd>
                    </li>
                    <li class="list-group-item d-flex row">
                        <dt class="col-sm-2">Status :</dt>
                        <dd class="col-sm-9"><span class="text-dark bg-info px-1 rounded">{{ $task->status }}</span></dd>
                    </li>
                    <li class="list-group-item d-flex row">
                        <dt class="col-sm-2">Deadline :</dt>
                        <dd class="col-sm-9"><span class="fw-bold">{{ $task->created_at }}</span></dd>
                    </li>
                  </ul>
            </div>
        </div>
    </div>
    <!-- END DATA -->

@endsection
