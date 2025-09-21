<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'member_id', 'first_name', 'last_name', 'email', 'phone',
        'address_line1', 'address_line2', 'city', 'state', 'postal_code', 
        'created_by', 'updated_by'
    ];

    public function memberCourses()
    {
        return $this->hasMany(MemberCourse::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
    public function updator()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function memberBranches()
    {
        return $this->hasMany(MemberBranch::class);
    }
}
