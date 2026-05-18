<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    protected $fillable = [
        'name',
        'certificate_number',
        'image',
        'start_date',
        'expiry_date',
        'sort_order',
    ];
}
