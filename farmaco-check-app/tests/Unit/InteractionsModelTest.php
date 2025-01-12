<?php

use App\Models\Interaction;
use Illuminate\Database\Eloquent\Collection;

test('has fillable fields', function () {
    $interaction = new Interaction();

    expect($interaction->getFillable())->toContain('medicine_1_id');
    expect($interaction->getFillable())->toContain('medicine_2_id');
    expect($interaction->getFillable())->toContain('causes');
    expect($interaction->getFillable())->toContain('severity');
    expect($interaction->getFillable())->toContain('source');
});

test('can create an interaction instance with valid attributes', function () {
    $interaction = new Interaction([
        'medicine_1_id' => 1,
        'medicine_2_id' => 2,
        'causes' => 'May cause dizziness.',
        'severity' => 'moderate',
        'source' => 'Clinical study XYZ',
    ]);

    expect($interaction)->toBeInstanceOf(Interaction::class);
    expect($interaction->medicine_1_id)->toBe(1);
    expect($interaction->medicine_2_id)->toBe(2);
    expect($interaction->causes)->toBe('May cause dizziness.');
    expect($interaction->severity)->toBe('moderate');
    expect($interaction->source)->toBe('Clinical study XYZ');
});

test('retrieves the first medicine involved in the interaction', function () {
    $mockedRelationship = Mockery::mock(Collection::class);

    $interaction = Mockery::mock(Interaction::class)->makePartial();
    $interaction->shouldReceive('medicines1')->andReturn($mockedRelationship);

    $medicine = $interaction->medicines1();

    expect($medicine)->toBe($mockedRelationship);
});

test('retrieves the second medicine involved in the interaction', function () {
    $mockedRelationship = Mockery::mock(Collection::class);

    $interaction = Mockery::mock(Interaction::class)->makePartial();
    $interaction->shouldReceive('medicines2')->andReturn($mockedRelationship);

    $medicine = $interaction->medicines2();

    expect($medicine)->toBe($mockedRelationship);
});
