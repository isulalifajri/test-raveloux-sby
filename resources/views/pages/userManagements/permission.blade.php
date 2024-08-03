@extends('layouts.main')

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Data permission</h1>
            <div class="table-responsive">
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Permission</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $paginate => $item)
                            <tr>
                                <td>{{ $permissions->firstItem() + $paginate }}</td>
                                <td><span class="badge bg-info">{{ $item->name }}</span></td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
            <div class="mt-2 d-flex justify-content-end">
                {{ $permissions->links() }}
            </div>
        </div>
@endsection


