<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('hazard_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('barangay');
            $table->string('hazard_type');
            $table->integer('families_affected');
            $table->integer('persons');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('hazard_data');
    }
};
