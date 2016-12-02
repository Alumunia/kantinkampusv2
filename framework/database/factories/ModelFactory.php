<?php

/*
  |--------------------------------------------------------------------------
  | Model Factories
  |--------------------------------------------------------------------------
  |
  | Here you may define all of your model factories. Model factories give
  | you a convenient way to create models for testing and seeding your
  | database. Just tell the factory how a default model should look.
  |
 */

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Member::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->userName,
        'namaSekolah' => $faker->company,
        'namaTim' => $faker->name,
        'regional' => $faker->address,
        'noTelpSekolah' => $faker->phoneNumber,
        'emailSekolah' => $faker->email,
        'namaLengkapAnggota1' => $faker->name,
        'kelasAnggota1' => $faker->jobTitle,
        'noHpAnggota1' => $faker->phoneNumber,
        'emailAnggota1' => $faker->email,
        'pathFotoAnggota1' => $faker->fileExtension,
        'pathKartuPelajarAnggota1' => $faker->fileExtension,
        'namaLengkapAnggota2' => $faker->name,
        'kelasAnggota2' => $faker->jobTitle,
        'noHpAnggota2' => $faker->phoneNumber,
        'emailAnggota2' => $faker->email,
        'pathFotoAnggota2' => $faker->fileExtension,
        'pathKartuPelajarAnggota2' => $faker->fileExtension,
        'namaLengkapAnggota3' => $faker->name,
        'kelasAnggota3' => $faker->jobTitle,
        'noHpAnggota3' =>$faker->phoneNumber,
        'emailAnggota3' => $faker->email,
        'pathFotoAnggota3' => $faker->fileExtension,
        'pathKartuPelajarAnggota3' => $faker->fileExtension,
        'namaLengkapPebimbing' => $faker->name,
        'noIndukPebimbing' => $faker->numberBetween(),
        'noHpPebimbing' => $faker->phoneNumber,
        'emailPebimbing' => $faker->email,
        'pathFotoPebimbing' => $faker->fileExtension,
        'pathKTPPebimbing' => $faker->fileExtension,
        'pathBuktiPembayaran' => str_random(10),
        'statusPendaftaran' => '0',
        'password' => bcrypt('root'),
        'remember_token' => str_random(10),
    ];
});
