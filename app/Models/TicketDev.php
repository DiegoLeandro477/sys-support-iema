<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot as RelationsPivot;

class TicketDev extends RelationsPivot
{
    protected $table = "ticket_dev";
}
