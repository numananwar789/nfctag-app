<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UidMapping extends Model
{
    use HasFactory;

    protected $fillable = [
        'old_uid',
        'new_uid',
        'counter',
    ];

    // Define any relationships if needed
}
