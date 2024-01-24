<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Upload;
use App\Models\Signed;
use App\Models\SignatureFile;
use Illuminate\Http\Request;
use DB;

class UploadController extends Controller
{
    //
    public function index()
    {
        // $users = User::where($id, 'id');
        $allfile = Upload::count();

        $users = User::find(auth()->user()->id);
        $upload = Upload::where('users_id', auth()->user()->id)->get();  
        // $status = [];
        // foreach($upload as $up){
        //     $nama = Signed::findOrFail($up->users_id);
        //     array_push($status, $nama->status);
        // }
        // $req = Signed::where('signer_id', auth()->user()->id)->get();
        // $users = User::orderBy('id')->get();
        // $upload = Upload::with('users')->orderBy('file')->get();
         
        return view('client.upload', compact('users', 'upload', 'allfile'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'file.*' => 'required|mimes:pdf|max:4048',
            // 'users_id' => 'required'
        ]);

        // dd($request->users_id);
        // $upload = Upload::with('users')->find($request->users_id);

        if($request->file('file')){
            // FileDocumentModel::where('dokumen_id', $id)->delete();
            foreach ($request->file as $file) {
                $destinationPath = 'storage/app/public/Upload';
                $explode = explode('.', $file->getClientOriginalName());
                $originalName = $explode[0];
                $extensi = $file->getClientOriginalExtension();
                $filename = 'Dok_'.rand(11111, 99999). '-'. $file->getClientOriginalName();
                // $filename = 'Dok_'.$detail_rapats->rapats_id.'_'.$detail_rapats->users_id.'.'.$extensi;
                // $filename = 'Dok_'.$rapat->rapat_ke.'_'.$rapat->tahun_sidang_rapat.'_'.$rapat->masa_sidang_rapat.'.'.$extensi;
                
                // $dokumen = $file->move('public/file',$filename);
                $dokumen = $file->move($destinationPath, $filename);
                Upload::updateOrCreate(
                    [
                        'id' => $request->id
                    ],
                    [
                        'file' =>$filename,
                        'users_id' => auth()->user()->id,
                    ]
                );
            } 
        }
        
        

        if ($request->id) {
            return redirect()->route('client.upload')->with('success', 'Success Update Upload!');
        } else {
            // return redirect()->back()->with('success', 'Success Add Upload!');
            return redirect()->back()->with('success', 'Success Upload!');

        }
    }

    public function showSignatureRequest(){
        $req = Signed::where('users_id', auth()->user()->id)->get();
        // $req_s = Signed::where('signer_id', auth()->user()->id)->get();
       
        
        return view('client.meminta', compact('req'));
    }

    public function showSignFile(){
        // $req = Signed::where('users_id', auth()->user()->id)->get();
        // $req_s = Signed::where('signer_id', auth()->user()->id)->get();
        $sign_file = SignatureFile::where('users_id', auth()->user()->id)->get();        
        // return view('client.signedFile');
        for($i=0; $i<count($sign_file); $i++){
            $sign_file[$i]['file_signed'] = base64_decode($sign_file[$i]['file_signed']); 
            $sign_file[$i]['file_name'] = base64_decode($sign_file[$i]['file_name']); 

        }
        // var_dump($sign_file);
        return view('client.signedFile', compact('sign_file'));

    }

    public function DownloadBarcode($file_signed){
        // $req = Signed::where('users_id', auth()->user()->id)->get();
        // $req_s = Signed::where('signer_id', auth()->user()->id)->get();
        // $decode_file_name = ($file_name);
        // $sign_file = SignatureFile::where('id', 3)->get();        
        // return view('client.signedFile');
        // for($i=0; $i<count($sign_file); $i++){
        //     $sign_file[$i]['file_signed'] = base64_decode($sign_file[$i]['file_signed']); 
        //     $sign_file[$i]['file_name'] = base64_decode($sign_file[$i]['file_name']); 

        // }
        // var_dump(base64_decode($file_name));
        return redirect(base64_decode($file_signed));

    }

    public function checkFile($id)
    {
        $upload = Signed::find(decrypt($id));
        return view('client.checkFile', compact('upload'));
    }

    public function checkFileTtd($id)
    {
        $upload = SignatureFile::find($id);
        return view('client.checksigned', compact('upload'));
    }

    public function destroy($id)
    {
        Upload::find($id)->delete();
        return redirect()->back()->with('success', 'Success Delete File!');
    }

    public function destroySigned($id)
    {
        SignatureFile::find($id)->delete();
        return redirect()->back()->with('success', 'Success Delete File!');
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("upload")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"File Deleted successfully."]);
    }

    
    // public function show()
    // {
    //     return view('client.uploaded');
    // }

}
