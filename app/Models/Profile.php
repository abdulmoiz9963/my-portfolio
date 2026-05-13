<?php
// app/Models/Profile.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'location', 'tagline', 'about',
        'linkedin', 'github', 'profile_image', 'cv_path'
    ];
}
