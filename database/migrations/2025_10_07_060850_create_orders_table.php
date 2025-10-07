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
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('nama_pemesan');
            $table->string('alamat');
            $table->integer('jumlah');
            $table->enum('kurir',['JNE','JNT','POS']);
            $table->enum('metode', ['COD','TRANSFER']);
            $table->enum('status', ['Pending','Processed','Canceled','Confirmed','Sending',])->default('Pending');
            $table->unsignedBigInteger('total_harga')->default(0);
            $table->timestamps();
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
