<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'active_ingredient',
        'therapeutic_class',
        'dosage',
        'manufacturer',
    ];

    public function interactions()
    {
        return $this->belongsToMany(Medicine::class, 'interactions', 'medicine_id', 'related_medicine_id')
            ->withPivot('causes', 'severity', 'source')
            ->withTimestamps();
    }
}
