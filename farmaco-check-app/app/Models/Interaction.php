<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Interaction
 *
 * Represents a medication interaction in the system between two medicines.
 *
 * @property int $medicine_1_id The ID of the first medicine in the interaction.
 * @property int $medicine_2_id The ID of the second medicine in the interaction.
 * @property string $causes A description of the causes of the interaction.
 * @property string $severity The severity level of the interaction.
 * @property string $source The source of information about the interaction.
 */
class Interaction extends Model
{
    use HasFactory;

    // Table associated with the model
    protected $table = 'interactions';

    // Fields that can be mass-assigned
    protected $fillable = [
        'medicine_1_id',
        'medicine_2_id',
        'causes',
        'severity',
        'source',
    ];

    /**
     * Get the first medicine involved in the interaction.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function medicines1()
    {
        return $this->belongsTo(Medicine::class, 'medicine_1_id');
    }

    /**
     * Get the second medicine involved in the interaction.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function medicines2()
    {
        return $this->belongsTo(Medicine::class, 'medicine_2_id');
    }
}
