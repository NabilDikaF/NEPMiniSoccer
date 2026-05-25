<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function dashboard(){
        return view('admin-dashboard');
    }

    public function verifikasi(){
        return view('admin-verifikasi');
    }

    public function jadwal(){
        return view('admin-jadwal');
    }

    public function pelanggan(){
        return view('admin-dataPelanggan');
    }

}
