@extends('layouts.main')

@section('content')
    <h3 class="my-3">Halaman Notifacation</h3>
    @forelse ($notifications as $notification)
        <div class="card my-2">
            <div class="card-body">
                <a href="{{ route('detail-notification', $notification ) }}" class="text-decoration-none">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-dark">
                            <h5 class="card-title">{{ $notification->data['text_title'] }}</h5>
                            <p class="card-text">{{ $notification->data['messages'] }}</p>
                        </div>
                        @if(!$notification->read())
                            <h5 class="text-info">Belum dibaca</h5>
                        @else
                            <h6 class="text-success">Sudah dibaca</h6>
                        @endif
                    </div>
                    <div class="mt-2">
                        <div class="d-flex align-items-center justify-content-between">
                            @if(!$notification->read())
                            <form action="{{ route('mark-as-read', $notification->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn text-link p-0" style="color:blue;"><b>Tandai Sudah dibaca</b></button>
                            </form>
                            @endif
                            <span class="text-small">{{$notification->created_at->diffForHumans()}}</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    @empty
        <div class="card my-2">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-dark">
                        <h5 class="card-title">Tidak ada Notifikasi</h5>
                    </div>
                </div>
            </div>
        </div>
    @endforelse

    <p>{{ $notifications->links() }}</p>

@endsection



