<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'headline', 'about_text', 'cv_link', 
        'avatar', 'email', 'github_link', 'linkedin_link'
    ];
}