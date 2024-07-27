@extends('layouts.main')

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Data Projects</h1>
            <div class="d-flex gap-1">
                <a href="{{ route('create.projects') }}" class="btn btn-primary">Tambah Data</a>
                <a href="{{ route('softDeletes.projects') }}" class="btn btn-warning">softDeletes</a>
            </div>
            <form action="">
                <div class="d-flex flex-wrap gap-1 my-2">
                    <div class="col-md-4 col-12">
                        <input type="search" class="form-control" placeholder="Search.." name="search" value="{{ request('search') }}">
                    </div>
                    <div class="col-md-4 col-12">
                        @php
                            $status = ['open', 'close','done','in progress'];  
                        @endphp
                        <select class="form-select w-100" id="status" name="status">
                            <option value="">Select Status</option>
                            @foreach ($status as $st)
                                <option value="{{ $st }}" {{ request('status') == $st ? 'selected' : '' }}>{{ $st }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-secondary" type="submit">Filter Data</button>
                    <a href="{{ route('projects') }}" class="btn btn-secondary"><i data-feather="refresh-cw"></i></a>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Assigned User</th>
                            <th>Assigned Client</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($projects as $paginate => $item)
                            <tr>
                                <td>{{ $projects->firstItem() + $paginate }}</td>
                                <td><img src="{{ $item->products_url }}" alt="{{ $item->title }}" width="70px"></td>
                                <td>{{ $item->title }}</td>
                                <td>{!! optional($item->user)->first_name ?? '<span class="text-danger">User tidak ada / User dihapus</span>' !!}</td>
                                <td>{!! optional($item->client)->contact_name ?? '<span class="text-danger">Client tidak ada / Client dihapus</span>' !!}</td>
                                <td>{{ date('d M Y', strtotime($item->deadline)) }}</span></td>
                                <td><span class="badge bg-primary">{{ $item->status }}</span></td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('edit.projects', $item->id) }}" class="btn btn-info btn-sm">Edit</a>
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('destroy.projects', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9"><h3 class="text-center">Tidak ada data yang tersedia</h3></td>
                            </tr>
                        @endforelse
                        
                    </tbody>
                </table>
            </div>
            <div class="mt-2 d-flex justify-content-end">
                {{ $projects->links() }}
            </div>
    </div>
@endsection
