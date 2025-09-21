<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberBranch extends Model
{
    protected $fillable = [
        'member_id', 'branch_id', 'start_date', 'end_date', 
        'is_current', 'created_by', 'updated_by'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
    public function updator()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
