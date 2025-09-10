<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';

    protected $fillable = [
        'system',
        'status',
        'description',
        'closed_at',
        'user_client_id',
    ];

    // Relacionamento com o usuário cliente (Many-to-One)
    public function client()
    {
        return $this->belongsTo(User::class, 'user_client_id');
    }

    // Relacionamento com o usuário dev (Many-to-Many)
    public function devs()
    {
        return $this->belongsToMany(User::class, 'ticket_dev', 'ticket_id', 'user_dev_id');
    }
}
