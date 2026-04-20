<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = ['role', 'company', 'period', 'description', 'type', 'cv_descriptions'];

protected $casts = [
    'cv_descriptions' => 'array',
];
}