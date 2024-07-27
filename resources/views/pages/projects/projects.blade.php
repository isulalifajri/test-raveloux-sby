@extends('layouts.main')

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Data Projects</h1>
            <div class="d-flex gap-1">
                <a href="{{ route('create.projects') }}" class="btn btn-primary">Tambah Data</a>
                <a href="{{ route('softDeletes.projects') }}" class="btn btn-warning">softDeletes</a>
            </div>
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
                        @foreach ($projects as $paginate => $item)
                            <tr>
                                <td>{{ $projects->firstItem() + $paginate }}</td>
                                <td><img src="{{ $item->products_url }}" alt="{{ $item->title }}" width="70px"></td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->user->first_name }}</td>
                                <td>{{ $item->client->contact_name }}</td>
                                <td>{{ date('d M Y - H:i:s', strtotime($item->deadline)) }}</span></td>
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
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
            <div class="mt-2 d-flex justify-content-end">
                {{ $projects->links() }}
            </div>
    </div>
@endsection
