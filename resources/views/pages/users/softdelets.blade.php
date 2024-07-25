@extends('layouts.main')

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Data Users SoftDeletes</h1>
            <a href="{{ route('users') }}" class="btn btn-secondary">Back</a>
            <div class="table-responsive">
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $paginate => $item)
                            <tr>
                                <td>{{ $users->firstItem() + $paginate }}</td>
                                <td>{{ $item->first_name }} {{ $item->last_name }}</td>
                                <td>{{ $item->phone_number }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->address }}</span></td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('restore.users', $item->id) }}" class="btn btn-info btn-sm">Restore</a>
                                        <form onsubmit="return confirm('Apakah Anda Yakin Ingin Menghapus Data ini Secara Permanent ?');" action="{{ route('forcedelete.users', $item->id) }}" method="POST">
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
                {{ $users->links() }}
            </div>
    </div>
@endsection
