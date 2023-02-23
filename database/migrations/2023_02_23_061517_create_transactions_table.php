<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('jenis_service'); // relasi ke table service
            $table->integer('karyawan_id'); // relasi ke user role 1
            $table->integer('status_akhir'); // MASIH PENGERJAAN = ada transaksi detail yang belum selesai, SELESAI = semua transaksi detail SELESAI
            $table->integer('client_id'); // relasi ke table client detail
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
        Schema::dropIfExists('transactions');
    }
}
