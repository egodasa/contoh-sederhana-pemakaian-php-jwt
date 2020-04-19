<?php
header('Content-Type: application/json');
require "vendor/autoload.php";
require_once "jwt-helper.php";

// Buat objek jwt
$jwt = new JwtHelper();
$jwt->SetAlgoHash('HS256');
$jwt->SetPrivateKey("j+_^%&G*@vbhJ!(()");

$response = array(
  "code" => 401,
  "message" => "Not Allowed!",
  "data" => null
);

if($_SERVER['REQUEST_METHOD'] == "POST")
{
  if(!empty($_POST['username']))
  {
    // semua data $_POST akan dimasukan kedalam token
    $token = $jwt->BuatToken($_POST); // proses membuat token
    $response["code"] = 200;
    $response["message"] = "Ok";
    $response["data"] = $token;
  }
}
echo json_encode($response);

?>
