<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Mark all unread notifications as read.
     */
    public function markAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back()->with('success', 'All notifications marked as read.');
    }

    /**
     * Mark a specific notification as read and redirect to its URL.
     */
    public function read($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        
        // Mark as read
        $notification->markAsRead();
        
        // Get URL from data or default to home/index
        $url = $notification->data['url'] ?? route('dashboard');
        
        return redirect($url);
    }

    /**
     * Check for new notifications (AJAX Polling).
     */
    public function check()
    {
        $user = Auth::user();
        $notifications = $user->unreadNotifications;
        $unreadCount = $notifications->count();
        $latest = $notifications->first();
        
        // Render the notification list HTML (Show latest 20 history)
        $historyNotifications = $user->notifications()->latest()->limit(20)->get();
        $notificationsHtml = view('user.partials.notification-list', [
            'notifications' => $historyNotifications
        ])->render();

        return response()->json([
            'count' => $unreadCount,
            'html' => $notificationsHtml,
            'latest_id' => $latest ? $latest->id : null,
            'latest_title' => $latest ? ($latest->data['title'] ?? 'New Notification') : null,
            'latest_message' => $latest ? ($latest->data['message'] ?? '') : null,
            'latest_type' => $latest ? ($latest->data['type'] ?? 'info') : null,
        ]);
    }
}
