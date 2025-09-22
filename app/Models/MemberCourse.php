<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberCourse extends Model
{
    protected $fillable = [
        'id','member_id', 'course_id', 'enrollment_date', 'completion_date', 
        'status', 'created_by', 'updated_by', 'card_number', 'issue_date', 'expiry_date'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
    public function updator()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
