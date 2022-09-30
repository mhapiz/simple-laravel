<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kamar', function (Blueprint $table) {
            $table->id('id_kamar');
            $table->string('nama_kamar');
            $table->string('jenis_kamar');
            $table->double('harga_kamar');
            $table->enum('ketersediaan', ['isi', 'tersedia']);
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
        Schema::dropIfExists('tb_kamar');
    }
};
