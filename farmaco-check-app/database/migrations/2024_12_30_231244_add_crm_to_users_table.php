<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * This method is used to apply the migration. It modifies the 'users' table
     * by adding a new column 'crm' which is a nullable string field. The new
     * column is inserted after the 'email' column in the 'users' table.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('crm')
                ->unique()
                ->nullable()
                ->after('email');
        });
    }

    /**
     * Reverse the migrations.
     * 
     * This method is used to reverse the migration. It drops the 'crm' column
     * from the 'users' table. It is called when rolling back the migration.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('crm');
        });
    }
};
