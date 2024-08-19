<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NfcAccessLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'uid',
        'counter',
        'ip_address',
        'status',
    ];

    // Define relationship with NfcTag model
    public function nfcTag()
    {
        return $this->belongsTo(NfcTag::class, 'uid', 'uid');
    }
}
