<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangayPopulation extends Model
{
    use HasFactory;

    protected $table = 'barangay_population'; // Explicitly defining table name (optional)

    protected $fillable = [
        'name',
        'households',
        'families',
        'males',
        'females',
        'lgbtq',
        'population',
        'user_id'
    ];
}
