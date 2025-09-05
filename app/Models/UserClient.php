<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserClient extends Model
{
    protected $fillable = [
        'user_id',
        'unidade',
        'number_phone',
    ];

    public function tickets()
    {
        return $this->hasMany(\App\Models\Ticket::class, 'user_client_id', 'user_id');
    }
}
