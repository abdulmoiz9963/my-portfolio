<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'role', 'company', 'start_date', 'end_date', 'type',
        'description', 'tech_stack', 'sort_order'
    ];
}
