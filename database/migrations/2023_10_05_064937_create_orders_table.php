<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_sepatu');
            $table->foreign('id_sepatu')->references('id')->on('shoes');
            $table->string('kode_unik')->unique();;
            $table->integer('total');
            $table->string('status_pesanan');
            $table->timestamps();
        });

        // Schema::create('order_details', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('id_order');
        //     $table->foreign('id_order')->references('id')->on('orders');
        //     $table->unsignedBigInteger('id_sepatu');
        //     $table->integer('jumlah');
        //     $table->integer('total');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
