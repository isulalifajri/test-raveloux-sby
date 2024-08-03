<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function index()
    {
        try {
            $title = 'Halaman Notification';
            $notifications = DatabaseNotification::orderBy('created_at','DESC')->paginate(10);
            return view('pages.notification.notification', compact(
                'title', 'notifications'
            ));
        } catch (\Exception $th) {
            return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
        }
    }

    public function markAsRead($id)
    {
        try {
            $notification = DatabaseNotification::findOrFail($id);
            $notification->markAsRead();
            return redirect()->back(); // Redirect ke halaman sebelumnya
        } catch (\Exception $th) {
            return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
        }
    }

    public function detailNotification($notification){
        try {
            $notification = DatabaseNotification::findOrFail($notification);
            $notification->markAsRead();
            return redirect($notification->data['route']);
        } catch (\Exception $th) {
            return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
        }
    }
}
