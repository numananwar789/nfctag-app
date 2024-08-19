<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NfcTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'uid',
        'user_id',
        'counter',
    ];

    // Define relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define relationship with NfcAccessLog model
    public function accessLogs()
    {
        return $this->hasMany(NfcAccessLog::class, 'uid', 'uid');
    }
}
