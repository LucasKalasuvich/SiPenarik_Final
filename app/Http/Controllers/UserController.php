<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Upload;
use App\Models\PIN;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allfile = Upload::count();
        $user = User::orderBy('level')->orderBy('nama')->get();
        return view('server.user.index', compact('user', 'allfile'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::find(auth()->user()->id);
        $pin = PIN::where('users_id', auth()->user()->id)->get();
        return view('client.pengaturan', compact('users', 'pin'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|string',
            'username' => 'required|string|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'email' => 'required|email',
            'bagian' => 'required|string',
            'nip' => 'required',
            'telepon' => 'required|numeric',
            'level' => 'required'
        ]);

        User::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'nama' => $request->nama,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'email' => $request->email,
                'bagian' => $request->bagian,
                'nip' => $request->nip,
                'telepon' => $request->telepon,
                'level' => $request->level
            ]
        );

        if ($request->id) {
            return redirect()->route('user.index')->with('success', 'Success Update Users!');
        } else {
            return redirect()->back()->with('success', 'Success Add Users!');
        }

        // User::create([
        //     'nama' => $request->nama,
        //     'username' => $request->username,
        //     'password' => Hash::make($request->password),
        //     'email' => $request->email,
        //     'bagian' => $request->bagian,
        //     'nip' => $request->nip,
        //     'telepon' => $request->telepon,
        //     'level' => $request->level
        // ]);

        // return redirect()->back()->with('success', 'Success Add User!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find(decrypt($id));
        return view('server.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find(decrypt($id))->delete();
        return redirect()->back()->with('success', 'Success Delete User!');
    }

    public function name(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|string',
            'username' => 'required|string|unique:users',
            'email' => 'required|email',
            'bagian' => 'required|string',
            'nip' => 'required',
            'telepon' => 'required|numeric',
        ]);

        User::find(Auth::user()->id)->update([
                'nama' => $request->nama,
                'username' => $request->username,
                'email' => $request->email,
                'bagian' => $request->bagian,
                'nip' => $request->nip,
                'telepon' => $request->telepon,
        ]);

        return redirect()->back()->with('success', 'Data anda berhasil diperbarui!');
    }

    public function password(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = User::find(Auth::user()->id);

        if ($request->password_lama == true) {
            if (Hash::check($request->password_lama, $user->password)) {
                if ($request->password_lama == $request->password) {
                    return redirect()->back()->with('error', 'Maaf password yang anda masukkan sama!');
                } else {
                    $user_password = [
                        'password' => Hash::make($request->password),
                    ];
                    $user->update($user_password);
                    return redirect()->back()->with('success', 'Password anda berhasil diperbarui!');
                }
            } else {
                return redirect()->back()->with('error', 'Tolong masukkan password lama anda dengan benar!');
            }
        } else {
            return redirect()->back()->with('error', 'Tolong masukkan password lama anda terlebih dahulu!');
        }
    }

    public function pin(Request $request){
        
        // PIN::where('')
        PIN::where('users_id', auth()->user()->id)->delete();

        $this->validate($request, [
            'pin' => 'required|string|min:8',
        ]);
        // PIN::destroy(auth()->user()->id);
        PIN::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'pin' => Hash::make($request->pin),
                'users_id' => auth()->user()->id
            ]
        );

        return redirect()->back()->with('success', 'PIN Berhasil Dibuat!');
    }

    public function pinUser(Request $request, $id){
       
        // PIN::where('id', auth()->user()->id)->delete();

        $pin = PIN::where('users_id', auth()->user()->id)->first();
        // $pin = PIN::find(auth()->user()->id);
        $upload = Upload::find($id);
        // dd($pin->pin, Hash::check($request->pin));
        if(password_verify($request->pin, $pin->pin)){
            // dd($pin);
            // $filePath = public_path("storage\app\public\Upload\\").$upload->file;
            return redirect()->route('certout', $id);
        }
        return redirect()->back()->with('error', 'PIN Salah', compact('pin'));
    }

    public function pinReq(Request $request, $id){
       
        // $pin = PIN::find(auth()->user()->id);
        $pin = PIN::where('users_id', auth()->user()->id)->first();
        $upload = Upload::find($id);
        // dd($pin->pin, Hash::check($request->pin));
        if(password_verify($request->pin, $pin->pin)){
            // dd($pin);
            // $filePath = public_path("storage\app\public\Upload\\").$upload->file;
            return redirect()->route('statusApproved', $id);
        }
        return redirect()->back()->with('error', 'PIN Salah', compact('pin'));
    }
}
