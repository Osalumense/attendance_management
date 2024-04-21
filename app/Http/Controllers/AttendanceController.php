<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Attendance;
use Auth;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    //
    public function markAttendance($userId){
        // try {
            $user = User::find($userId);
            $loggedInUser = Auth::user()->id;
            if(!loggedInUser || Auth::user()->role !== 'admin')
            {
                return response()->json(['error' => 'You are not ad admin and cannot register user attendance'], 400);
            }
            if (!now()->isSunday()) {
                return response()->json(['error' => 'Attendance marking is only allowed on Sundays'], 400);
            }
            $attendance = new Attendance([
                'user_id' => $user->id,
                'attendance_date' => now(),
                'isPresent' => 1,
                'recorded_by' => $loggedInUser
            ]);
            $attendance->save();
            // return view('admin.users.add_users');
            return response()->json(['message' => 'Attendance marked successfully!'], 200);
        // } catch (\Throwable $th) {
        //     return response()->json(['error' => 'Invalid QR code or error marking attendance'], 400);
        // }
    }

    public function getAttendanceList()
    {
        $attendance = Attendance::with(['user', 'recordedBy'])->get();
        return view('admin.attendance.list')
        ->with([
            'attendance' => $attendance
        ]);
    }
}
