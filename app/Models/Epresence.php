<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Epresence extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id_users',
        'type',
        'is_approve',
        'waktu',
    ];

    public const TYPE = [
        self::OUT,
        self::IN,
    ];
    public const OUT = 'OUT';
    public const IN = 'IN';
}
