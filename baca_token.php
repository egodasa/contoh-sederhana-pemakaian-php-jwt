<?php
require "vendor/autoload.php";
use \Firebase\JWT\JWT;

header('Content-Type: application/json');

$response = array(
  "code" => 401,
  "message" => "Token not valid!",
  "data" => null
);



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



// KITA PAKAI TRY CATCH AGAR SAAT PROSES PEMBACAAN TOKEN
// DAN TERNYATA ADA YANG SALAH DENGAN TOKEN
// KITA CUKUP BERI RESPONSE 401 PADA CATCH UNTUK CLIENT

try {
  // KEDUA, KITA CEK DULU APAKAH TOKENNYA ADA ATAU TIDAK
  if(!empty($token))
  {
    // KETIGA, PASTIKAN ISI TOKENNYA ADALAH "Bearer TOKEN_JWT"
    $hasil_token = explode(" ", $token); // isi token dipisah berdasarkan spasi
    
    if(count($hasil_token) == 2) // hasil explode token harus 2
    {
      if($hasil_token[0] == "Bearer") // isi token pertama adalah tulisan "Bearer"
      {
        // proses pembacaan token
        //~ // PRIVATE KEY, SAMA SEPERTI YANG KITA PAKAI SEBELUMNYA SAAT MEMBUAT TOKEN
        $key = "j+_^%&G*@vbhJ!(()";
        
        //~ // PROSES VALIDASI TOKEN
        $data = JWT::decode($hasil_token[1], $key, array('HS256'));
        
        //~ /* OUTPUT */
        //~ echo $data->username;
        //~ echo $data->tgl_login;
        
        // KITA KEMBALIKAN ISI TOKEN KE USER DALAM BENTUK JSON
        $response["code"] = 200;
        $response["message"] = "Ok";
        $response["data"] = $data; // data berisi username dan tgl_login dari token yg telah di buat di buat_token.php
      }
    }
  }
  echo json_encode($response);
}
catch(Exception $e) {
  $response["error"] = $e->getMessage();
  echo json_encode($response);
}

?>
