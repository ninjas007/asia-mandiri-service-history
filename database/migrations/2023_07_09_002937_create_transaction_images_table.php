<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uniq_string'); // untuk menentukan bahwa file itu ada beberapa dalam satu kali upload.. 
            $table->string('file_id'); // file id dari filepond
            $table->string('file_name');
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
        Schema::dropIfExists('transaction_images');
    }
}
