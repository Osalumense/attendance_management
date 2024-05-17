<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Attendance;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    //
    public function adminDashboard()
    {
         // Data for the users chart
         $userRegistrations = User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
         ->groupBy('date')
         ->pluck('count', 'date')
         ->toArray();

        // $userDates = $userRegistrations->pluck('date');
        // $userCounts = $userRegistrations->pluck('count');
        // dd($userDates . ' '. $userCounts);
        // Data for the attendance chart
        $attendanceRecords = Attendance::selectRaw('DATE(created_at) as date, COUNT(*) as count')
         ->groupBy('date')
         ->pluck('count', 'date')
         ->toArray();

        $allDates = array_unique(array_merge(array_keys($userRegistrations), array_keys($attendanceRecords)));
        sort($allDates);
        $userCounts = [];
        $attendanceCounts = [];
    
        foreach ($allDates as $date) {
            $userCounts[] = $userRegistrations[$date] ?? 0;
            $attendanceCounts[] = $attendanceRecords[$date] ?? 0;
        }
     
        // $attendanceDates = $attendanceRecords->pluck('date');
        // $attendanceCounts = $attendanceRecords->pluck('count');
        return view('admin.index')->with([
            'totalUsers' => User::countNonAdminUsers(),
            'totalAttendanceCount' => Attendance::getTotalAttendanceCount(),
            'todaysAttendanceCount' => Attendance::getTotalAttendanceCountForToday(),
            'allDates' => $allDates,
            'userCounts' => $userCounts,
            'attendanceCounts' => $attendanceCounts,
            'user'=> Auth::user()
        ]);
    }

    public function generateUserQrCode()
    {
        $user = Auth::user();
        $userData = $user->id . ', ' . $user->email;
        $qrCode = QrCode::size(500)
                ->format('png')
                ->generate(config('base_url').'/admin/attendance/mark/'.$user->id, public_path('qr_codes/'. $user->id .'.png'));
        
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
