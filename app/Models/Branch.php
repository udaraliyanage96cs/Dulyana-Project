<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'name',
        'zone_id',
        'address_line1',
        'address_line2',
        'city',
        'state',
        'postal_code',
        'email',
        'phone',
        'status',
        'created_by',
        'updated_by',
    ];

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updator()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function committees()
    {
        return $this->hasMany(Committee::class);
    }

    public function memberBranches()
    {
        return $this->hasMany(MemberBranch::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

}
