<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'member_id', 'first_name', 'last_name', 'email', 'phone',
        'address_line1', 'address_line2', 'city', 'state', 'postal_code', 
        'created_by', 'updated_by', 
        'blue_card_available',
        'blue_card_number',
        'blue_card_issue',
        'blue_card_expire',
        'yellow_card_available',
        'yellow_card_number',
        'yellow_card_issue',
        'yellow_card_expire',
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

    public function memberCommittees()
    {
        return $this->hasMany(MemberCommittee::class);
    }
}
