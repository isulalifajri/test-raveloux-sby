<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;

class Notifications
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // $user = Auth::user();

        // if ($user) {
        //     $notifications = $user->notifications;
        //     $unreadCount = $user->unreadNotifications->count();
        // } else {
        //     $notifications = [];
        //     $unreadCount = 0;
        // }

        // view()->share('notifications', $notifications);
        // view()->share('unreadCount', $unreadCount);

        // Mendapatkan semua notifikasi
        // $notifications = DatabaseNotification::all();
        $notifications = DatabaseNotification::latest()->take(5)->get();

        // Menghitung jumlah notifikasi yang belum dibaca
        $unreadCount = DatabaseNotification::whereNull('read_at')->count();

        view()->share('notifications', $notifications);
        view()->share('unreadCount', $unreadCount);
        
        return $next($request);
    }
}
