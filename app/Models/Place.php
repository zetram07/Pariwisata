<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    public const STATUS_OPEN = 'open';
    public const STATUS_CLOSE = 'close';

    protected $fillable = [
        'name',
        'description',
        'location',
        'capacity',
        'operation_time',
        'status',
        'ticket_price',
    ];

    protected $casts = [
        'operation_time' => 'array',
    ];

    public function photos()
    {
        return $this->hasMany(PlacePhoto::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
