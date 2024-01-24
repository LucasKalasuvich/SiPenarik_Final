<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Signed;
use App\Models\Upload;
use App\Models\Feedback;
use App\Models\PIN;
use App\Models\SignatureFile;
use Illuminate\Http\Request;
use DB;

class RequestSignController extends Controller
{
    public function index($id)
    {
        // $user = User::where('level' ,'=', 'Users')->get();
        $user = User::all();
        $upload = Upload::find(decrypt($id));
        return view('client.requestsign', compact('user', 'upload'));
    }
    
    public function store(Request $request, $id)
    {
        $data = $request->validate([
            'keterangan' => 'required'
        ]);
        
        // dd($request);
        $signed = new Signed();
        $signed->keterangan = $request->keterangan;
        $signed->users_id = auth()->user()->id;   
        $signed->files_id = $id;   
        $signed->signer_id = $request->nama;
        // $Instansi = Instansi::findOrFail($request->alamatInstansi_users_id);
        $signed->save();
        // $users->dataInstansi_users()->attach($Instansi->id, ['instansi_users' => $Instansi->nama_instansi, 'alamatInstansi_users' => $Instansi->alamat_instansi]);
   
        return redirect('/upload')->with('success',' Data berhasil dikirim.');
    }
    
    public function show()
    {
        $req = Signed::where('signer_id', auth()->user()->id)->get();
       
        
        return view('client.permintaan', compact('req'));
    }

    public function req($id)
    {
        $upload = Signed::find(decrypt($id));
        return view('client.appOrdecSign', compact('upload'));
    }

    public function destroy($id)
    {
        Signed::find($id)->delete();
        return redirect()->back()->with('success', 'Success Delete Data!');
    }

    public function destroySigned($id)
    {
        SignatureFile::find($id)->delete();
        return redirect()->back()->with('success', 'Success Delete Data!');
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("requestsigned")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"File Deleted successfully."]);
    }

    public function statusApproved(Request $request, $id){
        
        $signed = Signed::find($id);
        $signed->update([
            'status' => 'Approved'
            // 'petugas_id' => Auth::user()->id
        ]);
        $file_name = 'Dok_TTD'. '-'. rand(11111, 99999) . '.pdf';

        SignatureFile::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'file_signed' =>base64_encode('/certoutReq/' . $id),
                'file_name' =>base64_encode($file_name),
                'users_id' => $signed->users_id,
                'dokumen_id' =>$id
            ]
        );
        return redirect()->back()->with('success', 'Success!');
    }

    public function statusDecline($id){
        Signed::find($id)->update([
            'status' => 'Decline'
            // 'petugas_id' => Auth::user()->id
        ]);

        return redirect()->back()->with('success', 'Success!');
    }

    public function feedback(Request $request, $id)
    {
        $pin = PIN::where('users_id', auth()->user()->id)->first();
        $upload = Upload::find($id);
        // dd($pin->pin, Hash::check($request->pin));
        
        // return redirect()->back()->with('error', 'PIN Salah', compact('pin'));
        // dd($request);
        

        if(password_verify($request->pin, $pin->pin)){
            $data = $request->validate([
                'feedback' => 'required'
            ]);
            
            // dd($request);
            $feedback = new Feedback();
            $feedback->feedback = $request->feedback;
            $feedback->users_id = auth()->user()->id;   
            $feedback->signer_id = $id;
            // $Instansi = Instansi::findOrFail($request->alamatInstansi_users_id);
            $feedback->save();
            // dd($pin);
            // $filePath = public_path("storage\app\public\Upload\\").$upload->file;
            return redirect()->route('statusDecline', $id);
        }
        // $users->dataInstansi_users()->attach($Instansi->id, ['instansi_users' => $Instansi->nama_instansi, 'alamatInstansi_users' => $Instansi->alamat_instansi]);
   
        // return redirect('/signreq')->with('success',' Data berhasil dikirim.');
        // return redirect()->back()->with('success', 'Success!');
        return redirect()->back()->with('error', 'PIN Salah', compact('pin'));

    }
}
