<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Upload;
use App\Models\Signed;
use App\Models\SignatureFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

// 
// require_once(realpath(dirname(__FILE__) . '/../tcpdf/tcpdf_include'));

use setasign\Fpdi\Tcpdf\Fpdi;


class SignController extends Controller
{
    public function index($id)
    {
        $upload = Upload::find(decrypt($id));
        return view('client.pilihTipe', compact('upload'));
    }
    
    public function show(Request $request, $id)
    {
        require_once('../vendor/tecnickcom/tcpdf/examples/tcpdf_include.php');
        // require_once('../vendor/tecnickcom/tcpdf/config/tcpdf_config.php');
        require_once('../vendor/tecnickcom/tcpdf/tcpdf.php');
        require_once('../vendor/setasign/fpdi/src/autoload.php');
        $upload = Upload::find($id);
        // $uploads = Upload::where('users_id', $id)->get();
        // return $uploads;
        $pdf = new Fpdi('P', PDF_UNIT, 'A4', true, 'UTF-8', false);

        // set the source file
        $file_pdf = $pdf->setSourceFile(public_path('storage\app\public\Upload\\').$upload->file);
        // Storage::disk('public')->move($file_pdf);
        // $file_pdf = $pdf->setSourceFile('D:\xampp\htdocs\Signaty\public\storage\app\public\Upload\\'.$upload->file);
        for ($i = 1; $i <= $file_pdf; $i++)
			{
				$pdf->AddPage();
				$page = $pdf->importPage($i);
				$pdf->useTemplate($page, 0, 0);
			}

            $style = array(
                'border' => 3,
                'padding' => 2,
                // 'hpadding' => 'auto',
                'fgcolor' => array(50,50,50),
                'bgcolor' => array(255,255,255), //array(255,255,255)
                // 'module_width' => 1, // width of a single module in points
                // 'module_height' => 1 // height of a single module in points
            );

            $file_name = 'Dok_TTD'. '-'. rand(11111, 99999) . '.pdf';
            SignatureFile::updateOrCreate(
                [
                    'id' => $request->id
                ],
                [
                    'file_signed' =>base64_encode('/certout/' . $id),
                    'file_name' =>base64_encode($file_name),
                    'users_id' => auth()->user()->id,
                    'dokumen_id' =>$id
                ]
            );

        //set auto page breaks
        $pdf->SetAutoPageBreak(0, PDF_MARGIN_BOTTOM);

        //set image scale factor
        // $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        
        // $pdf->SetAutoPageBreak(TRUE);
        
        $pdf->SetFont('times', '', 8);
        $text = "Dokumen ini telah ditandatangani secara elektronik:"."\n"."Bag. ".auth()->user()->bagian."\n"."\n".auth()->user()->nama."\n"."NIP.".auth()->user()->nip;
        $pdf->Image('img/setjen1.jpg', 85, 249, 17, 17, 'JPG');
        $barout = 'Ditandatangani secara elektronik oleh: '.' ' . auth()->user()->nama . '.' . ' ' .'Pada ' . $upload->created_at;
        $pdf->write2DBarcode($barout, 'QRCODE,M', 107, 250, 15, 15, $style, 'N');
        

        // $baroutt = "http://localhost:8000/signedFile/";
        

        // if (isset($baroutt) and ! is_null($baroutt)) {
            
        // }
        $baroutt = "http://localhost:8000/signedFile/" .$upload->dokumenSigned->file_signed;
        $cipher = "AES-256-CBC";
        $salt = "G3RB4N6S3L4T4N";
        $options = 0;
        $iv = str_repeat("0",openssl_cipher_iv_length($cipher));
        $encryptedString = openssl_encrypt($baroutt, $cipher, $salt, $options, $iv);

        $decryptedString = openssl_decrypt($encryptedString, $cipher, $salt, $options, $iv);

        $pdf->write2DBarcode($encryptedString, 'QRCODE,M', 20, 275, 15, 15, $style, 'N');
        $pdf->Ln();
        $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(0,0,0);
        $pdf->MultiCell(70, 300, $text, 0, 'J', false, 1, 125, 249, true, 0, false, true, 0, 'T', false);
        $pdf->setSignatureAppearance(180, 60, 15, 15);
        
        
        // echo $encryptedString;
        // $pdf->addEmptySignatureAppearance(180, 80, 15, 15);

        // $certificate = file_get_contents('file://'.realpath('D:\OpenSSL-Win64\bin\luzhan.crt'));
        // $privKey = file_get_contents('file://'.realpath('D:\OpenSSL-Win64\bin\signaty.key'));
       
        //==proses Impelemnatasi tanda tangan elektronik============================================================================================================================================================
        $detail = array(
            "countryName" => "ID",
			"stateOrProvinceName" => "DKI Jakarta",
			"localityName" => "Jakarta Pusat",
			"organizationName" => "LUZHAN",
			"organizationalUnitName" => "Computer Science",
			"commonName" => auth()->user()->nama,
			"emailAddress" => auth()->user()->email
        );
        // dd($certificateout);
        $privKey = openssl_pkey_new(array(
            "private_key_bits" => 4096,
            "private_key_type" => OPENSSL_KEYTYPE_RSA
        ));
        $certificate = openssl_csr_new($detail, $privKey, array('digest_alg' => 'sha512'));
		openssl_csr_export($certificate, $certificateout);
		openssl_pkey_export($privKey, $pkeyout);
        // return $certificateout;
        // ==============Buat dapetin public key============================
        // $public_key_pem = openssl_pkey_get_details($privKey)['key'];
        // echo $public_key_pem;
        // $public_key = openssl_pkey_get_public($public_key_pem);
        // var_dump($public_key);
        // =================================================================

        $x509 = openssl_csr_sign($certificate,null,$privKey, $day=365, array('digest_alg' => 'sha512'));
		openssl_x509_export($x509, $crtout);
        // return $crtout;
        $info = array('Location' => 'PUSTEKINFO', 'Name' => auth()->user()->name, 'Organization' => 'LUZHAN');
        $pdf->setSignature($crtout, $pkeyout, 'pdf', '', 1, $info);
        ob_end_clean();
        $file_end = $pdf->Output($file_name, 'I');
        // $request->move(public_path('storage\app\public\Upload\\'), $file_end);
    }

    public function certoutRequestSignature($id)
    {
        require_once('../vendor/tecnickcom/tcpdf/examples/tcpdf_include.php');
        // require_once('../vendor/tecnickcom/tcpdf/config/tcpdf_config.php');
        require_once('../vendor/tecnickcom/tcpdf/tcpdf.php');
        require_once('../vendor/setasign/fpdi/src/autoload.php');

        $file_name = 'Dok_TTD'. '-'. rand(11111, 99999) . '.pdf';

        $upload = Signed::find($id);
        $pdf = new Fpdi();
        
        // set the source file
        $file_pdf = $pdf->setSourceFile(public_path('storage\app\public\Upload\\').$upload->file->file);
        // dd($upload->file->dokumenSigned);

        // $file_pdf = $pdf->setSourceFile('D:\xampp\htdocs\Signaty\public\storage\app\public\Upload\\'.$upload->file);
        for ($i = 1; $i <= $file_pdf; $i++)
			{
				$pdf->AddPage();
				$page = $pdf->importPage($i);
				$pdf->useTemplate($page, 0, 0);
			}
            $style = array(
                'border' => 3,
                'padding' => 2,
                // 'hpadding' => 'auto',
                'fgcolor' => array(50,50,50),
                'bgcolor' => array(255,255,255), //array(255,255,255)
                // 'module_width' => 1, // width of a single module in points
                // 'module_height' => 1 // height of a single module in points
            );


           

        $pdf->SetAutoPageBreak(0, PDF_MARGIN_BOTTOM);


        // $pdf->AddPage();
        // $pdf->SetAutoPageBreak(0);
        $pdf->SetFont('times', '', 8);
        $text = "Dokumen ini telah ditandatangani secara elektronik:"."\n"."Bag. ".$upload->signer->bagian."\n"."\n".$upload->signer->nama."\n"."NIP.".$upload->signer->nip;
        $pdf->Image('img/setjen1.jpg', 85, 249, 17, 17, 'JPG');
        $barout = 'Ditandatangani secara elektronik oleh: '.' ' . $upload->signer->nama . '.' . ' ' .'Pada ' . $upload->file->created_at;
        $pdf->write2DBarcode($barout, 'QRCODE,M', 107, 250, 15, 15, $style, 'N');

        $baroutt = "http://localhost:8000/signedFile/". $upload->file->dokumenSigned->file_signed;
        $pdf->write2DBarcode($baroutt, 'QRCODE,M', 20, 275, 15, 15, $style, 'N');
        $pdf->Ln();
        $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(0,0,0);
        $pdf->MultiCell(70, 300, $text, 0, 'J', false, 1, 125, 249, true, 0, false, true, 0, 'T', false);
        $pdf->setSignatureAppearance(180, 60, 15, 15);
        // $pdf->addEmptySignatureAppearance(180, 80, 15, 15);

        // $certificate = file_get_contents('file://'.realpath('D:\OpenSSL-Win64\bin\luzhan.crt'));
        // $privKey = file_get_contents('file://'.realpath('D:\OpenSSL-Win64\bin\signaty.key'));
       
        //==proses Impelemnatasi tanda tangan elektronik==
        $detail = array(
            "countryName" => "ID",
			"stateOrProvinceName" => "DKI Jakarta",
			"localityName" => "Jakarta Pusat",
			"organizationName" => "LUZHAN",
			"organizationalUnitName" => "Computer Science",
			"commonName" => $upload->signer->nama,
			"emailAddress" => $upload->signer->email
        );
        // dd($certificateout);
        $privKey = openssl_pkey_new(array(
            "private_key_bits" => 4096,
            "private_key_type" => OPENSSL_KEYTYPE_RSA
        ));
        $certificate = openssl_csr_new($detail, $privKey, array('digest_alg' => 'sha512'));
		openssl_csr_export($certificate, $certificateout);
		openssl_pkey_export($privKey, $pkeyout);
        // return $certificateout;
        // ==============Buat dapetin public key============================
        // $public_key_pem = openssl_pkey_get_details($privKey)['key'];
        // echo $public_key_pem;
        // $public_key = openssl_pkey_get_public($public_key_pem);
        // var_dump($public_key);
        // =================================================================

        $x509 = openssl_csr_sign($certificate,null,$privKey, $day=365, array('digest_alg' => 'sha512'));
		openssl_x509_export($x509, $crtout);
        $info = array('Location' => 'PUSTEKINFO', 'Name' => $upload->signer->nama, 'Organization' => 'LUZHAN');
        $pdf->setSignature($crtout, $pkeyout, 'pdf', '', 1, $info);
      
        $pdf->Output( $file_name . '.pdf', 'D');
    }
}