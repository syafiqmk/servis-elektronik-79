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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->text('phone_number')->nullable();
            $table->text('detail');
            $table->text('image')->nullable();
            $table->enum('status', ['Baru', 'Proses', 'Belum Diambil', 'Sudah Diambil', 'Batal']);
            $table->text('price')->nullable();
            $table->foreignId('category_id')->constrained('device_categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
