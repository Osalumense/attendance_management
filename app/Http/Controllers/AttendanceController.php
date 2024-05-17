<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Attendance;
use Auth;
use Illuminate\Http\Request;

use Carbon\Carbon;

class AttendanceController extends Controller
{
    //
    public function markAttendance($userId){
        // try {
            $user = User::find($userId);
            if(empty($user)) {
                return view('admin.attendance.mark-attendance-response')->with([
                    'status' => 'error',
                    'message' => 'User not found'
                ]);
            }
            if($user->role == 'admin') {
                return view('admin.attendance.mark-attendance-response')->with([
                    'status' => 'error',
                    'message' => 'You cannot mark register for an admin'
                ]);
            }
            $loggedInUser = Auth::user()->id;
            if(!$loggedInUser || Auth::user()->role !== 'admin')
            {
                return view('admin.attendance.mark-attendance-response')->with([
                    'status' => 'error',
                    'message' => 'You are not an admin and cannot register user attendance'
                ]);
                // return response()->json(['error' => 'You are not an admin and cannot register user attendance'], 400);
            }
            //Attendance is only marked on Sundays, this line enforces that
            if (!now()->isSunday()) {
                return view('admin.attendance.mark-attendance-response')->with([
                    'status' => 'error',
                    'message' => 'Attendance marking is only allowed on Sundays'
                ]);
                // return response()->json(['error' => 'Attendance marking is only allowed on Sundays'], 400);
            }
            $attendance = new Attendance([
                'user_id' => $user->id,
                'attendance_date' => now(),
                'isPresent' => 1,
                'recorded_by' => $loggedInUser
            ]);
            $attendance->save();
            $user_name = $user->surname . ' ' . $user->othernames;
            return view('admin.attendance.mark-attendance-response')->with([
                'status' => 'success',
                'message' => "Attendance marked successfully for $user_name!"
            ]);
            // return response()->json(['message' => 'Attendance marked successfully!'], 200);
    }

    public function getAttendanceList()
    {

        $firstAttendanceDate = Attendance::orderBy('attendance_date')->value('attendance_date');

        // If there are no attendance records, set a default start date (e.g., 3 months ago)
        if (!$firstAttendanceDate) {
            $startDate = Carbon::now()->subMonths(3)->startOfMonth();
        } else {
            $startDate = Carbon::parse($firstAttendanceDate)->startOfMonth();
        }
        $endDate = Carbon::now();
        // dd($startDate.' '. $endDate);

        // Retrieve all users
        $users = User::where('role', '!=', 'admin');
        $attendanceRecords = Attendance::whereBetween('attendance_date', [$startDate, $endDate])
        ->get()
        ->groupBy('user_id');

        // Generate list of Sundays within the date range
        $sundays = [];
        $currentDate = $startDate->copy()->next(Carbon::SUNDAY);

        while ($currentDate <= $endDate) {
            $sundays[] = $currentDate->format('Y-m-d');
            $currentDate->addWeek();
        }
        $attendanceData = [];

        foreach ($users as $user) {
            $userAttendance = [];

            foreach ($sundays as $sunday) {
                // Check if user has an attendance record for the given Sunday
                $isPresent = isset($attendanceRecords[$user->id]) && 
                             $attendanceRecords[$user->id]->contains('attendance_date', $sunday);
                $userAttendance[$sunday] = $isPresent ? 'Present' : 'Absent';
            }

            $attendanceData[] = [
                'user' => $user,
                'attendance' => $userAttendance
            ];
        }
        // $attendance = Attendance::with(['user', 'recordedBy'])->get();
        return view('admin.attendance.list')
        ->with([
            'attendanceData' => $attendanceData,
            'sundays' => $sundays
        ]);
    }
}
