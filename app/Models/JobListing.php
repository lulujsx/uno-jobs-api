<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    protected function casts(): array
    {
        return [
            'technologies' => 'array',
        ];
    }

    protected $fillable = [
    'title',
    'company',
    'seniority',
    'modality',
    'location',
    'technologies',
    'external_url',
    'status',
    'description',
];
}
