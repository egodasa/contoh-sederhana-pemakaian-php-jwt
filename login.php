<?php
require "vendor/autoload.php";
use \Firebase\JWT\JWT;

$response = array(
  "code" => 401,
  "message" => "Not Allowed!",
  "data" => null
);

if($_SERVER['REQUEST_METHOD'] == "POST")
{
  if(!empty($_POST['username']))
  {
    /* PROSES MEMBUAT TOKEN */
    /* ==================== */
    // PRIVATE KEY ATAU KUNCI RAHASIA KITA UNTUK MEMBUAT TOKEN
    // HARUS BERUPA STRING DAN BOLEH TERSERAH
    $key = md5(md5(md5("44509fb639e991")."44509fb639e991").md5(date("YmdHis")));
    
    // DATA YANG INGIN DIMASUKKAN KEDALAM TOKEN
    $data = array(
        "username" => $_POST['username'],
        "tgl_login" => date("Y-m-d H:i:s")
    );
    
    // PROSES MEMBUAT TOKEN
    $token = JWT::encode($data, $key); // TOKEN AKAN DISIMPAN DIVARIABEL INI, BERUPA STRING
    
    /* =============================== */
    /* AKHIR DARI PROSES MEMBUAT TOKEN */
    
    $response["code"] = 200;
    $response["message"] = "Ok";
    $response["data"] = $token;
  }
}
echo json_encode($response);


/* PROSES MEMBACA TOKEN */
/* BAGIAN INI DIKOMENTARI KODENYA KARENA KITA HANYA INGIN MEMBUAT TOKEN */
/* ==================== */
// PRIVATE KEY ATAU KUNCI RAHASIA KITA UNTUK MEMBUAT TOKEN
// HARUS BERUPA STRING DAN BOLEH TERSERAH

//~ // INI TOKEN YANG DIDAPAT DARI USER
//~ $token = "dsfohfoehofehohhfsaesiieife";

//~ // PRIVATE KEY, SAMA SEPERTI YANG KITA PAKAI SEBELUMNYA
//~ $key = md5(md5(md5("44509fb639e991")."44509fb639e991").md5(date("YmdHis")));

//~ // PROSES VALIDASI TOKEN
//~ $data = JWT::decode($token, $key, array('HS256'));

//~ /* OUTPUT */

//~ echo $data->username;
//~ echo $data->tgl_login;

//~ /* EOF OUTPUT */

//~ /* =============================== */
//~ /* AKHIR DARI PROSES MEMBACA TOKEN */
    

?>
