<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class Interations extends Model
{
    use HasFactory;

    protected $table = 'interations';

    protected $fillable = [
        'medicine_id',
        'related_medicine_id',
        'causes',
        'severity',
        'source',
    ];
}
