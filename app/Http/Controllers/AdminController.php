<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    //
    public function adminDashboard()
    {
        $user = Auth::user();
        return view('admin.index')->with(['user'=> Auth::user()]);
    }

    public function generateUserQrCode()
    {
        $user = Auth::user();
        $userData = $user->id . ', ' . $user->email;
        $qrCode = QrCode::size(500)
                ->format('png')
                ->generate('https://google.com', public_path('qr_codes/'. $user->id .'.png'));
        
        // return view('qr-code');
        // $qrCode = QrCode::encoding('UTF-8')->format('png')->size(200)->generate($userData, public_path('qr_codes/' . $user->id . '_qr_code.png'));
        // dd($qrCode);
        return JsonResponse([
            'code' => 200,
            'data' => $qrCode,
            'message' => 'Successfully saved user QR code'
        ]);
    }

    public function adminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
    
    public function adminLogin()
    {
        return view('admin.login');
    }
}
