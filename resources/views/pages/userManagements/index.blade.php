@extends('layouts.main')

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Data Management Users</h1>
            <div class="d-flex gap-1">
                <a href="{{ route('managementUsers.permission') }}" class="btn btn-info">List Permission</a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Permission</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $paginate => $item)
                            <tr>
                                <td>{{ $users->firstItem() + $paginate }}</td>
                                <td>{{ $item->first_name }} {{ $item->last_name }}</td>
                                <td>
                                    @foreach ($item->roles as $role)
                                        <span class="badge bg-info">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($item->permissions as $permission)
                                        <span class="badge bg-primary">{{ $permission->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="#0" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->id }}"><span data-feather="info"></span></a>
                                        <a href="{{ route('managementUsers.edit', $item->id) }}" class="btn btn-success btn-sm"><span data-feather="edit"></span></a>
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


            <!-- Modal -->
            @foreach ($users as $item)
            <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">User Manajemen Details: {{ $item->first_name }} {{ $item->last_name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Role:</label>
                                    <input type="text" class="form-control" value="{{ $item->getRoleNames()->first() }}" readonly>
                            </div>
                            <p><strong>Permissions:</strong>
                                @foreach ($item->permissions as $permission)
                                    <span class="badge bg-primary">{{ $permission->name }}</span>
                                @endforeach
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
    </div>
@endsection


