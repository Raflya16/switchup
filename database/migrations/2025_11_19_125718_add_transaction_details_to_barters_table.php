<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('barters', function (Blueprint $table) {
            // Kolom untuk Resi
            $table->string('resi_owner')->nullable(); // Resi dari pemilik barang (A)
            $table->string('resi_offerer')->nullable(); // Resi dari penawar (B)
            
            // Kolom untuk Konfirmasi Penerimaan
            $table->boolean('confirmed_owner')->default(false); // A sudah terima barang?
            $table->boolean('confirmed_offerer')->default(false); // B sudah terima barang?
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('barters', function (Blueprint $table) {
            $table->dropColumn(['resi_owner', 'resi_offerer', 'confirmed_owner', 'confirmed_offerer']);
        });
    }
};
