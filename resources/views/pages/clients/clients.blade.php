@extends('layouts.main')

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Data Clients</h1>
            <div class="d-flex gap-1">
                <a href="{{ route('create.clients') }}" class="btn btn-primary">Tambah Data</a>
                <a href="{{ route('softDeletes.clients') }}" class="btn btn-warning">softDeletes</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Company</th>
                            <th>Vat</th>
                            <th>Address</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $paginate => $item)
                            <tr>
                                <td>{{ $clients->firstItem() + $paginate }}</td>
                                <td>{{ $item->company_name }}</td>
                                <td>{{ $item->company_vat }}</td>
                                <td>{{ $item->company_address }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('edit.clients', $item->id) }}" class="btn btn-info btn-sm">Edit</a>
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('destroy.clients', $item->id) }}" method="POST">
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
                {{ $clients->links() }}
            </div>
    </div>
@endsection
