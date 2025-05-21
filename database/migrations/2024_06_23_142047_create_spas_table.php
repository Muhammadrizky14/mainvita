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
        Schema::create('spas', function (Blueprint $table) {
            $table->id('id_spa');
            $table->string('nama');
            $table->integer('harga');
            $table->string('alamat');
            $table->string('noHP');
            $table->json('waktuBuka');
            $table->string('image')->nullable();
            $table->text('maps');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spas');
        Schema::table('spa', function (Blueprint $table) {
            $table->dropColumn('gambar');
        });
    }
};
