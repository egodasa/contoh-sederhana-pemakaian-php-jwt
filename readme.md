# Contoh pemakaian Json Web Token Pada PHP
1. File `buat_token.php` berisi kode untuk proses mengubah data klien menjadi token. Komentar sudah dituliskan pada kode tersebut.
2. File `baca_token.php` berisi kode untuk mengecek kevalidan token JWT yang dikirim oleh user melalui header Authorization pada http request. Komentar sudah dituliskan pada kode tersebut.

# Persiapan
1. Clone project ini dan jalankan `composer update` pada project ini lewat CMD/Terminal.
1. Lakukan HTTP Request metode "POST" ke file `buat_token.php` dengan data (body) "username". File tersebut akan mengembalikan token dari "username" yang dikirim.
1. Lakukan HTTP Request dengan sembarang metode pada file `baca_token.php` dan pada header request, sematkan header "Authorization" dengan isi "Bearer TOKEN_JWT_DARI_LANGKAH_SEBELUMNYA" untuk melakukan validasi terhadap token tersebut.
