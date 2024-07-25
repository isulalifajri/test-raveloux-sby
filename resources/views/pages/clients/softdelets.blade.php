@extends('layouts.main')

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Data Clients SoftDelets</h1>
            <a href="{{ route('clients') }}" class="btn btn-secondary">Back</a>
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
                                        <a href="{{ route('restore.clients', $item->id) }}" class="btn btn-info btn-sm">Restore</a>
                                        <form onsubmit="return confirm('Apakah Anda Yakin Ingin Menghapus Data ini Secara Permanent ?');" action="{{ route('forcedelete.clients', $item->id) }}" method="POST">
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
