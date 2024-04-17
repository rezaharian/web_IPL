<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Mendapatkan peran pengguna saat ini
        $userRole = Auth::user()->role_id;

        // Mengarahkan pengguna ke halaman sesuai dengan peran mereka
        switch ($userRole) {
            case 1:
                return redirect()->route('admin.index'); // Ganti dengan halaman admin yang sesuai
                break;

            case 2:
                return redirect()->route('user.index'); // Ganti dengan halaman user yang sesuai
                break;

                // Tambahkan case lain sesuai dengan peran lainnya


        }
    }
}
