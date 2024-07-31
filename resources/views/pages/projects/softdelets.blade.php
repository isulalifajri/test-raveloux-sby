@extends('layouts.main')

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Data Projects SoftDeletes</h1>
            <a href="{{ route('projects') }}" class="btn btn-secondary">Back</a>
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
                                <td>
                                    @php
                                        $mediaItem = $item->getFirstMedia('images/projects');
                                    @endphp
                                    
                                    @if ($mediaItem)
                                        <img src="{{ $mediaItem->getUrl() }}" alt="" width="70px" style="margin-right: 5px;">
                                    @else
                                        <img src="{{ asset('no-image.jpg') }}" alt="No image available" width="70px" style="margin-right: 5px;">
                                    @endif
                                </td>
                                <td>{{ $item->title }}</td>
                                <td>{!! optional($item->user)->first_name ?? '<span class="text-danger">User tidak ada / User dihapus</span>' !!}</td>
                                <td>{!! optional($item->client)->contact_name ?? '<span class="text-danger">Client tidak ada / Client dihapus</span>' !!}</td>
                                <td>{{ date('d M Y', strtotime($item->deadline)) }}</span></td>
                                <td><span class="badge bg-primary">{{ $item->status }}</span></td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('restore.projects', $item->id) }}" class="btn btn-info btn-sm">Restore</a>
                                        <form onsubmit="return confirm('Apakah Anda Yakin Ingin Menghapus Data ini Secara Permanent ?');" action="{{ route('forcedelete.projects', $item->id) }}" method="POST">
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
