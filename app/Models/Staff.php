<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    const ROLE = [
        0 => 'Nhân viên',
        1 => 'Quản lý',
    ];
    protected $table = 'nhanvien';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'tableId',
    ];

    public $timestamps = false;

    public function diaries()
    {
        return $this->hasMany(Diary::class, 'idNv', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'idNv', 'id');
    }
}
