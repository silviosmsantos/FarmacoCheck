<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Medicine
 *
 * Represents a medication in the system.
 *
 * @property string $name The name of the medicine.
 * @property string $active_ingredient The active ingredient of the medicine.
 * @property string $therapeutic_class The therapeutic class of the medicine.
 * @property string $dosage The dosage of the medicine.
 * @property string $manufacturer The manufacturer of the medicine.
 */

class Medicine extends Model
{
    use HasFactory;

     // Fields that can be mass-assigned
    protected $fillable = [
        'name',
        'active_ingredient',
        'therapeutic_class',
        'dosage',
        'manufacturer',
    ];

    /**
     * Get all interactions where this medicine is the first medicine.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function interactionsMedicine1()
    {
        return $this->hasMany(interaction::class, 'medicine_1_id');
    }

    /**
     * Get all interactions where this medicine is the second medicine.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function interactionsMedicine2()
    {
        return $this->hasMany(interaction::class, 'medicine_2_id');
    }
}
