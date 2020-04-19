<?php
header('Content-Type: application/json');
require "vendor/autoload.php";
require_once "jwt-helper.php";

// Buat objek jwt
$jwt = new JwtHelper();
$jwt->SetAlgoHash('HS256');
$jwt->SetPrivateKey("j+_^%&G*@vbhJ!(()");

$result = [
  "error" => true,
  "message" => null,
  "data" => null,
];

/* PETUNJUK */
/*
 * UNTUK MENGIRIM TOKEN KE HALAMAN INI UNTUK DIPROSES,
 * SILAHKAN AKSES HALAMAN INI DAN SEMATKAN TOKEN JWT KALIAN
 * PADA HEADER AUTHORIZATION DENGAN ISI BEARER TOKEN_KALIAN
 * CONTOH :
 * api.get("baca_token.php").Headers("Authorization", "Bearer TOKEN_JWT_KALIAN");
 * 
 * ATAU 
 * 
 * api.get("baca_token.php").Headers("Authorization", "Bearer jf3oijjf3jjjrnn3wri3wn3wrn3wnnewon3pn3dwn3d3w.3w3one3oih3ir3btb4b4otn34o4t4b.3rn3nt4no23ionio23nr");
 */

// PERTAMA, KITA AMBIL DULU TOKENNYA DARI HEADER
$header = apache_request_headers();
$token = $header["Authorization"];

// KEDUA, PROSES PENGECEKAN KEBERADAAN TOKEN
$data = $jwt->BacaToken($token);

// KETIGA, HASIL PEMBACAAN DIOPER KE KLIEN
echo json_encode($data);

?>
