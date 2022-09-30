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
        Schema::create('tb_sewa_kamar', function (Blueprint $table) {
            $table->id('id_sewa_kamar');
            $table->string('nama_pemesan');
            $table->text('alamat_pemesan');
            $table->unsignedInteger('kamar_id');
            $table->date('tgl_cekin');
            $table->integer('lama_menginap');
            $table->date('tgl_cekout')->nullable();
            $table->double('biaya_denda')->nullable();
            $table->double('biaya_tambahan')->nullable();
            $table->text('keterangan')->nullable();
            $table->double('total_bayar')->nullable();
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
        Schema::dropIfExists('tb_sewa_kamar');
    }
};
