<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PCalendar extends Model
{
    //
    protected $tables = 'p_calendars';
    protected $fillable = [
        'start_date', 'how_long', 'many_days',
    ];
}
