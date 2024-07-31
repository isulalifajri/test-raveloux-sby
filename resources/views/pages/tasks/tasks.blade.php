@extends('layouts.main')

@push('css')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

@endpush

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Data Tasks</h1>
            @can('admin')
                <div class="d-flex gap-1">
                    <a href="{{ route('create.tasks') }}" class="btn btn-primary">Tambah Data</a>
                    <a href="{{ route('softDeletes.tasks') }}" class="btn btn-warning">softDeletes</a>
                </div>
            @endcan
            <form action="">
                <div class="d-flex flex-wrap gap-1 my-2">
                    <div class="col-md-4 col-12">
                        <input type="date" class="form-control" name="deadline" id="deadline" value="{{ request('deadline') }}">
                    </div>
                    <div class="col-md-4 col-12">
                        @php
                            $status = ['open', 'close','done','in progress'];  
                        @endphp
                        <select class="form-select w-100 sl2" id="status" name="status">
                            <option value="">Select Status</option>
                            @foreach ($status as $st)
                                <option value="{{ $st }}" {{ request('status') == $st ? 'selected' : '' }}>{{ $st }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-secondary" type="submit">Filter Data</button>
                    <a href="{{ route('tasks') }}" class="btn btn-secondary"><i data-feather="refresh-cw"></i></a>
                </div>
            </form>
            <p>Noted : Warna <span class="text-danger">merah</span> artinya mendekati h-3 deadline, Warna <span class="text-warning">Kuning</span>  artinya melewati deadline.</p>
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
                        @forelse ($tasks as $paginate => $item)
                        @php
                            $now = strtotime(date('Y-m-d')); // Mendapatkan tanggal saat ini tanpa waktu
                            $deadline = strtotime($item->deadline); // Mendapatkan timestamp batas waktu
                            $daysLeft = ($deadline - $now) / 86400; // 86400 detik dalam sehari
                        @endphp
                            <tr class="{{ $daysLeft < 0 ? 'bg-warning text-dark' : ($daysLeft <= 3 ? 'bg-danger text-white' : '') }}">
                                <td>{{ $tasks->firstItem() + $paginate }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{!! optional($item->user)->first_name ?? '<span class="text-danger">User tidak ada / User dihapus</span>' !!}</td>
                                <td>{!! optional($item->client)->contact_name ?? '<span class="text-danger">Client tidak ada / Client dihapus</span>' !!}</td>
                                <td>{!! optional($item->project)->title ?? '<span class="text-danger">Project tidak ada / Project dihapus</span>' !!}</td>
                                <td>{{ date('d M Y', strtotime($item->deadline)) }}</span></td>
                                <td><span class="badge bg-primary">{{ $item->status }}</span></td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('detail.tasks', $item->id) }}" class="btn btn-primary btn-sm">Detail</a>
                                        @if (auth()->user()->hasRole('admin'))
                                            <a href="{{ route('edit.tasks', $item->id) }}" class="btn btn-info btn-sm">Edit</a>
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('destroy.tasks', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8"><h3 class="text-center">Tidak ada data yang tersedia</h3></td>
                            </tr>
                        @endforelse
                        
                    </tbody>
                </table>
            </div>
            <div class="mt-2 d-flex justify-content-end">
                {{ $tasks->links() }}
            </div>
    </div>
@endsection

@push('js')

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.sl2').select2({
            theme: "bootstrap-5",
            selectionCssClass: "select2--medium",
            dropdownCssClass: "select2--medium",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        });
    });
</script>
    
@endpush
