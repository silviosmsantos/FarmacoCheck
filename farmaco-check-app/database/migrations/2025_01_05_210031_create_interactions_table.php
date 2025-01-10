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
            $table->foreignId('medicine_1_id')->constrained('medicines')->onDelete('cascade');
            $table->foreignId('medicine_2_id')->constrained('medicines')->onDelete('cascade');
            $table->enum('severity', ['grave', 'moderada', 'leve']);
            $table->text('causes');
            $table->string('source');
            $table->timestamps();
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
