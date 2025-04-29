<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HazardData extends Model
{
    use HasFactory;

    protected $table = 'hazard_data'; // Explicitly defining table name (optional)

    protected $fillable = [
        'barangay',
        'hazard_type',
        'families_affected',
        'persons',
        'user_id'
    ];
}
