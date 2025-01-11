<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interaction extends Model
{
    use HasFactory;

    protected $table = 'interactions';

    protected $fillable = [
        'medicine_1_id',
        'medicine_2_id',
        'causes',
        'severity',
        'source',
    ];

    public function medicines1()
    {
        return $this->belongsTo(Medicine::class, 'medicine_1_id');
    }

    public function medicines2()
    {
        return $this->belongsTo(Medicine::class, 'medicine_2_id');
    }
}
