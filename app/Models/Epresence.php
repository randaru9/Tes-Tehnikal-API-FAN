<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'id_users');
    }
}
