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
    Schema::create('barters', function (Blueprint $table) {
        $table->id();

        // Pemilik barang yang DITAWAR
        $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
        // Barang yang DITAWAR
        $table->foreignId('requested_item_id')->constrained('items')->onDelete('cascade');

        // Pengguna yang MENAWARKAN
        $table->foreignId('offerer_id')->constrained('users')->onDelete('cascade');
        // Barang yang DITAWARKAN
        $table->foreignId('offered_item_id')->constrained('items')->onDelete('cascade');

        $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barters');
    }
};
