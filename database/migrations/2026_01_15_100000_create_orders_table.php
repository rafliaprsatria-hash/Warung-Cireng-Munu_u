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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelanggan');
            $table->unsignedBigInteger('cireng_id');
            $table->string('nama_produk');
            $table->integer('quantity');
            $table->decimal('total_harga', 10, 2);
            $table->enum('status', ['Selesai', 'Pending', 'Dibatalkan'])->default('Pending');
            $table->string('nomor_wa')->nullable();
            $table->timestamps();
            
            $table->foreign('cireng_id')->references('id')->on('cirengs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
