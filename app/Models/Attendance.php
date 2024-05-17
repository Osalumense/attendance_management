<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Attendance extends Model
{
    use HasFactory;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'attendance';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * Get the user associated with the attendance record.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the user who recorded the attendance.
    */
    public function recordedBy()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }

    public function setAttendanceDateAttribute($value)
    {
        $this->attributes['attendance_date'] = Carbon::parse($value);
    }

    public static function getTotalAttendanceCount()
    {
        return self::count();
    }

    public static function getTotalAttendanceCountForToday()
    {
        return self::whereDate('created_at', Carbon::today())->count();
    }

    
    
}
