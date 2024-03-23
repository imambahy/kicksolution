<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shoes', function (Blueprint $table) {
            $table->id();
            $table->integer('id_treatment');
            $table->integer('id_subtreatment');
            $table->string('kode_unik')->unique(); // Tambahkan kolom kode_unik
            $table->string('nama_pemilik');
            $table->string('nama_sepatu');
            $table->string('alamat');
            $table->string('gambar');
            $table->text('deskripsi');
            $table->string('ukuran');
            $table->string('warna');
            $table->integer('total');
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
        Schema::dropIfExists('shoes');
    }
}
