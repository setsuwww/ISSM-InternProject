<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employee_history', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('employee_nik');
            $table->string('roles_id');
            $table->string('locations_id');
            $table->string('jabatans_id');
            $table->string('fungsis_id');

            $table->string('tanggal_mulai_efektif', 25);
            $table->string('tanggal_akhir_efektif', 25);

            $table->boolean('current_flag')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_history');
    }
};
