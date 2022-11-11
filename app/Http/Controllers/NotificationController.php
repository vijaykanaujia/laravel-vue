<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'notifications' => $request->notifications ?: [],
            'badge' => $request->badge ?: 0,
            'notificationType' => $request->notificationType ?: 'limited'
        ];
        $user = auth()->user();
        switch ($data['notificationType']) {
            case 'all':
                $data['notifications'] = $user->notifications;
                break;
            case 'read':
                $data['notifications'] = $user->readNotifications;
                break;
            case 'unread':
                $data['notifications'] = $user->unreadNotifications;
                break;
            default:
                $data['notifications'] = $user->unreadNotifications()->limit(5)->get();
                break;
        }

        $data['badge'] = $user->unreadNotifications->count();
        return $this->success('success',$data);
    }

    public function delete(Request $request)
    {
        $user = auth()->user();
        if ($request->id != null) {
            $user->notifications()->where('id', $request->id)->delete();
            return $this->success('Deleted !');
        } else {
            $user->notifications()->delete();
            return $this->success('Cleared !');
        }

        return $this->error('Something went Wrong!');
    }

    public function markAsRead(Request $request)
    {
        $user = auth()->user();
        if ($request->id) {
            $user->unreadNotifications->where('id', $request->id)->markAsRead();
            return $this->success('Read !');
        } else {
            $user->unreadNotifications->markAsRead();
            return $this->success('Readed !');
        }

        return $this->error('Something went Wrong!');
    }
}
