<?php

namespace App\Http\Controllers;

// use App\Models\Pemesanan;
// use App\Models\Rute;
// use App\Models\Transportasi;
use App\Models\User;
use App\Models\Upload;
use App\Models\Signed;
use Illuminate\Http\Request;

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
        // $rute = Rute::count();
        // $pendapatan = Pemesanan::where('status', 'Sudah Bayar')->sum('total');
        // $transportasi = Transportasi::count();
        $allfile = Upload::where('users_id', auth()->user()->id)->get()->count();
        $requested_file = Signed::where('signer_id', auth()->user()->id)->get()->count();
        $request = Signed::where('users_id', auth()->user()->id)->get()->count();
        $user = User::count();
        return view('server.home', compact('user', 'allfile', 'requested_file', 'request'));
    }
}
