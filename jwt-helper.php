<?php
  use \Firebase\JWT\JWT;
  class JwtHelper {
    private $algo_hash;
    private $private_key;
    
    function __construct()
    {
      
    }
    
    public function SetAlgoHash($algo_hash)
    {
      $this->algo_hash = $algo_hash;
    }
    public function SetPrivateKey($private_key)
    {
      $this->private_key = $private_key;
    }
    
    // BuatToken($data array, $this->algo_hash string) string
    // @Param :
    // $data array : Data yang ingin dimasukan kedalam token JWT
    // $this->private_key String : Private key atau password untuk genrate token
    // $this->algo_hash string (optional) Default 'HS256' : Jenis algoritma yang digunakan untuk membuat JWT
    // Return string token
    public function BuatToken($data)
    {
      
      /* PROSES MEMBUAT TOKEN */
      /* ==================== */
      // PRIVATE KEY ATAU KUNCI RAHASIA KITA UNTUK MEMBUAT TOKEN
      // HARUS BERUPA STRING DAN BOLEH TERSERAH
      $key = $this->private_key;
      
      // DATA YANG INGIN DIMASUKKAN KEDALAM TOKEN
      $data_jwt = $data;
      $data_jwt['iss'] = time();
      
      // PROSES MEMBUAT TOKEN
      $token = JWT::encode($data_jwt, $key, $this->algo_hash); // TOKEN AKAN DISIMPAN DIVARIABEL INI, BERUPA STRING
      return $token;
      /* =============================== */
      /* AKHIR DARI PROSES MEMBUAT TOKEN */
    }
    
    // BacaToken($token string)
    // @Param :
    // $token : token jwt dengan Bearer
    // $this->private_key : private key untuk generate token
    
    // Return  array asosiatif:
    // $result["error"] bool : true berarti ada yang error, false berarti tidak ada error
    // $result["message"] string : isi pesan error jika terdapat error pada token
    // $result["data"] array asosiatif : data yang diambil dari hasil parse token
    public function BacaToken($token)
    {
      $result = [
        "error" => true,
        "message" => null,
        "data" => null,
      ];
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
              $key = $this->private_key;
              
              //~ // PROSES VALIDASI TOKEN
              $data = JWT::decode($hasil_token[1], $key, array($this->algo_hash));
              
              //~ /* OUTPUT */
              //~ echo $data->username;
              //~ echo $data->tgl_login;
              
              // KITA KEMBALIKAN ISI TOKEN KE USER DALAM BENTUK JSON
              $result["error"] = false;
              $result["data"] = $data; // data berisi username dan tgl_login dari token yg telah di buat di buat_token.php
            }
          }
        }
      }
      catch(Exception $e) {
        $result["message"] = $e->getMessage();
      }
      return $result;
    }
  }
?>
