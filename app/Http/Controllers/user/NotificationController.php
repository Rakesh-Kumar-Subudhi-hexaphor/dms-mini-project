<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAll()
    {
        Notification::where('is_read', false)->update(['is_read' => true]);
        return response()->json(['success' => true]);
    }
    public function markAsRead($id)
    {
        Notification::where('id', $id)->update(['is_read' => true]);
        return response()->json(['success' => true]);
    }
}
