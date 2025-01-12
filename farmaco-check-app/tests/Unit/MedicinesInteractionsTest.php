<?php

use App\Models\Medicine;
use App\Models\Interaction;

test('can create medicines and interactions manually', function () {
    
    $medicine1 = new Medicine([
        'name' => 'Paracetamol',
        'active_ingredient' => 'Paracetamol',
        'therapeutic_class' => 'Analgésico',
        'dosage' => '500mg',
        'manufacturer' => 'EMS',
    ]);
    
    $medicine2 = new Medicine([
        'name' => 'Ibuprofeno',
        'active_ingredient' => 'Ibuprofeno',
        'therapeutic_class' => 'Anti-inflamatório',
        'dosage' => '400mg',
        'manufacturer' => 'Merck',
    ]);

    $interaction = new Interaction([
        'medicine_1_id' => 1,
        'medicine_2_id' => 2,
        'severity' => 'grave',
        'causes' => 'Aumento da pressão arterial',
        'source' => 'https://example.com/estudoABC',
    ]);
    
    expect($medicine1->name)->toBe('Paracetamol');
    expect($medicine2->name)->toBe('Ibuprofeno');
    expect($interaction->severity)->toBe('grave');
    expect($interaction->causes)->toBe('Aumento da pressão arterial');
    expect($interaction->source)->toBe('https://example.com/estudoABC');

    $interactionMock = Mockery::mock(Interaction::class);
    $interactionMock->shouldReceive('medicines1')->andReturn($medicine1);
    $interactionMock->shouldReceive('medicines2')->andReturn($medicine2);

    expect($interactionMock->medicines1())->toBe($medicine1);
    expect($interactionMock->medicines2())->toBe($medicine2);

});
