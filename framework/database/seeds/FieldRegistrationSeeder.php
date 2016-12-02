<?php

use Illuminate\Database\Seeder;

class FieldRegistrationSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        //
        DB::table('field_registration')->insert(['question' => 'Username', 'type_question' => 'text', 'parameter_name' => 'username']);
        DB::table('field_registration')->insert(['question' => 'Password', 'type_question' => 'password', 'parameter_name' => 'password']);
        DB::table('field_registration')->insert(['question' => 'Nama Sekolah', 'type_question' => 'text', 'parameter_name' => 'namaSekolah']);
        DB::table('field_registration')->insert(['question' => 'Nama Tim', 'type_question' => 'text', 'parameter_name' => 'namaTim']);
        DB::table('field_registration')->insert(['question' => 'Regional', 'type_question' => 'select', 'parameter_name' => 'regional']);
        DB::table('field_registration')->insert(['question' => 'No Telp Sekolah', 'type_question' => 'text', 'parameter_name' => 'noTelpSekolah']);
        DB::table('field_registration')->insert(['question' => 'Email Sekolah', 'type_question' => 'email', 'parameter_name' => 'emailSekolah']);

        $arrayCaption = array('Ketua Tim', 'Anggota 1', 'Anggota 2');
        $j = 1;
        for ($i = 0; $i < 3; $i++) {
            //Anggota 1,2,3

            DB::table('field_registration')->insert(['question' => 'Nama ' . $arrayCaption[$i] . ' (kapital)', 'type_question' => 'text', 'parameter_name' => 'namaLengkapAnggota' . $j]);
            DB::table('field_registration')->insert(['question' => 'Kelas ' . $arrayCaption[$i] . ' (10/11/12) ', 'type_question' => 'number', 'parameter_name' => 'kelasAnggota' . $j]);
            DB::table('field_registration')->insert(['question' => 'No Telp ' . $arrayCaption[$i], 'type_question' => 'ntext', 'parameter_name' => 'noHpAnggota' . $j]);
            DB::table('field_registration')->insert(['question' => 'Email ' . $arrayCaption[$i], 'type_question' => 'email', 'parameter_name' => 'emailAnggota' . $j]);
            DB::table('field_registration')->insert(['question' => 'Upload Foto 3X4 ' . $arrayCaption[$i] . ' (ukuran file < 500kb, format :jpg,jpeg,png)', 'type_question' => 'file', 'parameter_name' => 'pathFotoAnggota' . $j]);
            DB::table('field_registration')->insert(['question' => 'Scan kartu pelajar / surat keterangan siswa aktif ' . $arrayCaption[$i] . ' (ukuran file < 500kb, format :jpg,jpeg,png)', 'type_question' => 'file', 'parameter_name' => 'pathKartuPelajarAnggota' . $j]);

            $j++;
        }


        //Pebimbing
        DB::table('field_registration')->insert(['question' => 'Nama Lengkap Pembimbing (gunakan kapital)', 'type_question' => 'text', 'parameter_name' => 'namaLengkapPebimbing']);
        DB::table('field_registration')->insert(['question' => 'Nomor Induk Pegawai', 'type_question' => 'text', 'parameter_name' => 'noIndukPebimbing']);
        DB::table('field_registration')->insert(['question' => 'No Telp Pembimbing', 'type_question' => 'text', 'parameter_name' => 'noHpPebimbing']);
        DB::table('field_registration')->insert(['question' => 'Email Pembimbing', 'type_question' => 'email', 'parameter_name' => 'emailPebimbing']);
        DB::table('field_registration')->insert(['question' => 'Upload Foto 3X4 Pembimbing (ukuran file < 500kb, format :jpg,jpeg,png)', 'type_question' => 'file', 'parameter_name' => 'pathFotoPebimbing']);
        DB::table('field_registration')->insert(['question' => 'Upload KTP Pembimbing (ukuran file < 500kb, format :jpg,jpeg,png)', 'type_question' => 'file', 'parameter_name' => 'pathKTPPebimbing']);

        //Others
        DB::table('field_registration')->insert(['question' => 'Upload Bukti Pembayaran (ukuran file < 500kb, format :jpg,jpeg,png)', 'type_question' => 'file', 'parameter_name' => 'pathBuktiPembayaran']);
        DB::table('field_registration')->insert(['question' => 'Kolom Persetujuan', 'type_question' => 'boolean', 'parameter_name' => 'kolomPersetujuan']);
        
        // Field Pembayaran tahap 2
        DB::table('field_registration')->insert(['question' => 'Upload Bukti Pembayaran Tahap II (ukuran file < 500kb, format :jpg,jpeg,png)', 'type_question' => 'file', 'parameter_name' => 'pathBuktiPembayaranTahap2']);
    }

}
