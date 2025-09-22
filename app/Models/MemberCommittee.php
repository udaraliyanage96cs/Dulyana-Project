<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberCommittee extends Model
{
    protected $fillable = [
        'member_id',
        'committee_id',
        'role',
        'start_date',
        'end_date',
        'created_by',
        'updated_by',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
    public function committee()
    {
        return $this->belongsTo(Committee::class);
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    public function role_get()
    {
        return $this->belongsTo(CommitteeRole::class, 'role');
    }
}
