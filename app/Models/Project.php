<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'description', 'tech_stack', 'image',
        'live_url', 'github_url', 'category', 'is_featured', 'sort_order'
    ];

    protected $casts = ['is_featured' => 'boolean'];
}
