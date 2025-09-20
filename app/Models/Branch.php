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

}
