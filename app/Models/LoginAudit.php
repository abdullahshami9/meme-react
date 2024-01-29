<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginAudit extends Model
{
    protected $table = 'login_audit';

    protected $fillable = [
        'profile_id_fk', // Add 'profile_id_fk' to the fillable array
        'login_at',
        'ip',
        'latitude',
        'longitude',
        'is_login',
    ];

    public $timestamps = false;

}
