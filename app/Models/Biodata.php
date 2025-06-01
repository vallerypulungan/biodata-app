<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    use HasFactory;

    protected $table = 'biodata';

    protected $fillable = [
        'nama',
        'foto',
        'universitas',
        'link_tautan',
        'summary',
        'organizational_experience',
        'volunteer_experience',
        'education',
        'achievement',
        'additional_information',
    ];

    protected $casts = [
        'link_tautan' => 'array',
        'organizational_experience' => 'array',
        'volunteer_experience' => 'array',
        'education' => 'array',
        'achievement' => 'array',
    ];
}
