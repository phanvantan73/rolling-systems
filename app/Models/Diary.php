<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    protected $table = 'diary';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'temp',
        'timein',
        'idNv',
        'timeout',
        'day',
    ];

    protected $appends = [
        'time_in_day',
        'time_out_day',
    ];

    public $timestamps = false;

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'idNv', 'id');
    }

    public function getTimeInDayAttribute()
    {
        return "{$this->attributes['day']} {$this->attributes['timein']}";
    }

    public function getTimeOutDayAttribute()
    {
        return "{$this->attributes['day']} {$this->attributes['timeout']}";
    }
}
