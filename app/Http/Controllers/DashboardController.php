<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AdminNotification;

class DashboardController extends Controller
{
    //
    public function dashboard(){
        // Notifikasi untuk modal (Semua)
        $allNotifications = AdminNotification::orderBy('created_at', 'desc')->get();

        // Notifikasi untuk Card (Max 20, prioritas: Belum Dibaca -> Urgent (hanya jika belum dibaca) -> Terbaru)
        $recentNotifications = AdminNotification::orderBy('is_read', 'asc')
                                                ->orderByRaw('CASE WHEN is_read = 0 THEN is_urgent ELSE 0 END DESC')
                                                ->orderBy('created_at', 'desc')
                                                ->take(20)
                                                ->get();

        return view('admin-dashboard', compact('allNotifications', 'recentNotifications'));
    }

    public function markNotificationRead(Request $request, $id) {
        $notif = AdminNotification::findOrFail($id);
        $notif->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }


    public function pelanggan(){
        return view('admin-dataPelanggan');
    }

}
