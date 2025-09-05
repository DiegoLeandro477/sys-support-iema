<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class userClient extends Model
{
    public function userClient()
    {
        $this->hasOne(\App\Models\UserClient::class, 'user_id');
    }
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'user_client_id', 'user_id');
    }
}
