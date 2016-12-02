<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;

class Member extends Authenticable {

    protected $table = 'member';
    protected $fillable = array(
        'username',
        'namaSekolah',
        'nama_tim',
        'regional',
        'no_hp',
        'email_sekolah',
        'nama_lengkap_anggota1',
        'kelas_anggota1',
        'no_hp_anggota1',
        'email_anggota1',
        'path_foto_anggota1',
        'path_kartu_pelajar_anggota1',
        'nama_lengkap_anggota2',
        'kelas_anggota2',
        'no_hp_anggota2',
        'email_anggota2',
        'path_foto_anggota2',
        'path_kartu_pelajar_anggota2',
        'nama_lengkap_anggota3',
        'kelas_anggota3',
        'no_hp_anggota3',
        'email_anggota3',
        'path_foto_anggota3',
        'path_kartu_pelajar_anggota3',
        'nama_lengkap_pebimbing',
        'no_induk_pebimbing',
        'no_hp_pebimbing',
        'email_pebimbing',
        'path_foto_pebimbing',
        'path_KTP_pebimbing',
        'path_bukti_pembayaran',
        'status_pendaftaran',
    );
    protected $hidden = [
        'password', 'remember_token',
    ];



}
