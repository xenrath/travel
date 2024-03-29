<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('produk_id');
            $table->unsignedInteger('pelanggan_id');
            $table->unsignedInteger('sopir_id')->nullable();
            $table->string('tanggal');
            $table->string('lama');
            $table->string('harga');
            $table->enum('metode', ['cash', 'transfer', 'null']);
            $table->string('bukti')->nullable();
            $table->enum('status', ['menunggu', 'proses', 'selesai', 'batal']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
