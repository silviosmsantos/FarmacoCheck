<?php

use App\Models\Medicine;
use Illuminate\Database\Eloquent\Collection;

test('has fillable fields', function () {
    $medicine = new Medicine();

    expect($medicine->getFillable())->toContain('name');
    expect($medicine->getFillable())->toContain('active_ingredient');
    expect($medicine->getFillable())->toContain('therapeutic_class');
    expect($medicine->getFillable())->toContain('dosage');
    expect($medicine->getFillable())->toContain('manufacturer');
});

test('can create a medicine instance with valid attributes', function () {
    $medicine = new Medicine([
        'name' => 'Paracetamol',
        'active_ingredient' => 'Paracetamol',
        'therapeutic_class' => 'Analgésico',
        'dosage' => '500mg',
        'manufacturer' => 'EMS',
    ]);

    expect($medicine)->toBeInstanceOf(Medicine::class);
    expect($medicine->name)->toBe('Paracetamol');
    expect($medicine->active_ingredient)->toBe('Paracetamol');
    expect($medicine->therapeutic_class)->toBe('Analgésico');
    expect($medicine->dosage)->toBe('500mg');
    expect($medicine->manufacturer)->toBe('EMS');
});

test('retrieves interactions where this medicine is the first one', function () {
    $mockedRelationship = Mockery::mock(Collection::class);

    $medicine = Mockery::mock(Medicine::class)->makePartial();
    $medicine->shouldReceive('interactionsMedicine1')->andReturn($mockedRelationship);

    $interactions = $medicine->interactionsMedicine1();

    expect($interactions)->toBe($mockedRelationship);
});

test('retrieves interactions where this medicine is the second one', function () {
    $mockedRelationship = Mockery::mock(Collection::class);

    $medicine = Mockery::mock(Medicine::class)->makePartial();
    $medicine->shouldReceive('interactionsMedicine2')->andReturn($mockedRelationship);

    $interactions = $medicine->interactionsMedicine2();

    expect($interactions)->toBe($mockedRelationship);
});
