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

    public function interactionsMedicine1()
    {
        return $this->hasMany(interaction::class, 'medicine_1_id');;
    }

    public function interactionsMedicine2()
    {
        return $this->hasMany(interaction::class, 'medicine_2_id');
    }
}
