@extends('layouts.main')

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Data Tasks SoftDeletes</h1>
            <a href="{{ route('tasks') }}" class="btn btn-secondary">Back</a>
            <div class="table-responsive">
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Assigned User</th>
                            <th>Assigned Client</th>
                            <th>Project</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $paginate => $item)
                            <tr>
                                <td>{{ $tasks->firstItem() + $paginate }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->user->first_name }}</td>
                                <td>{{ $item->client->contact_name }}</td>
                                <td>{{ $item->project->title }}</td>
                                <td>{{ date('d M Y - H:i:s', strtotime($item->deadline)) }}</span></td>
                                <td><span class="badge bg-primary">{{ $item->status }}</span></td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('restore.tasks', $item->id) }}" class="btn btn-info btn-sm">Restore</a>
                                        <form onsubmit="return confirm('Apakah Anda Yakin Ingin Menghapus Data ini Secara Permanent ?');" action="{{ route('forcedelete.tasks', $item->id) }}" method="POST">
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
                {{ $tasks->links() }}
            </div>
    </div>
@endsection
