@extends('layouts.main')

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Errors</h1>
           <div class="card">
                <div class="card-body">
                    <span>{{ $exception }}</span>
                </div>
           </div>
    </div>
@endsection
