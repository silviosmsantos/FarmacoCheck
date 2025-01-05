<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('interactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medicine_id')
                ->constrained('medicines')
                ->onDelete('cascade');
            $table->foreignId('related_medicine_id')
                ->constrained('medicines')
                ->onDelete('cascade');
            $table->text('causes');
            $table->enum('severity', ['Leve', 'Moderada', 'Grave']);
            $table->string('source');
            $table->timestamps();

            $table->unique(['medicine_id', 'related_medicine_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interactions');
    }
};
