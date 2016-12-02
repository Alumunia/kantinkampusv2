<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        //
        Schema::create('member', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('password', 60);
            $table->string('namaSekolah');
            $table->string('namaTim');
            $table->string('regional');
            $table->string('noTelpSekolah');
            $table->string('emailSekolah');

            for ($i = 1; $i <= 3; $i++) {
                // Anggota 1 2 3
                $table->string('namaLengkapAnggota' . $i);
                $table->integer('kelasAnggota' . $i);
                $table->string('noHpAnggota' . $i);
                $table->string('emailAnggota' . $i);
                $table->string('pathFotoAnggota' . $i);
                $table->string('pathKartuPelajarAnggota' . $i);
            }



            //Pebimbing
            $table->string('namaLengkapPebimbing');
            $table->string('noIndukPebimbing');
            $table->string('noHpPebimbing');
            $table->string('emailPebimbing');
            $table->string('pathFotoPebimbing');
            $table->string('pathKTPPebimbing');
            //Bukti pembayaran
            $table->string('pathBuktiPembayaran');
            $table->boolean('kolomPersetujuan');
            //Other
            $table->boolean('statusTim');
            $table->boolean('statusPendaftaran');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
        Schema::drop('member');
    }

}
