<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = "tickets";

    protected $fillable = [
        'user_id',
        'title',
        'posted',
        'content'
    ];

    protected $casts = [
        'posted' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
