# Technical Test Backend

Aplikasi ini menggunakan laravel sebagai backend dari aplikasi manajemen pegawai PNS 
## Database
Untuk dari tabel yang diberikan saya membuat suatu struktur sebagai berikut
![image](https://github.com/user-attachments/assets/8a970956-bc05-43ae-8848-16afbcba8a6d) <br>
Disini dibuat suatu struktur tabel utama untuk menyimpan pegawai pns lalu yang menghubungkan ke kota untuk kota lahir dari pegawai tersebut. Lalu yang terhubung lagi ada tabel untuk jabatan yang memiliki _relation_ dengan unit kerja dan juga kota. Table tersebut dibuat seperti ini dikarenakan aplikasi ini berniatan untuk suatu jabatan bisa ditambah dari unit kerja. Seperti dari jabatan PNS, setiap instansi memiliki jabatan yang berbeda beda maka dari itu aplikasi lebih baik bisa diberikan akses untuk menambah jabatan bergantung dengan instansi pns tersebut. Lalu di tabel unit kera ada untuk kategori yang menandakan apa kategori pns tersebut apa daerah ataupun pusat. lalu untuk penempatan dari unit kerja tersebut diberikan relasi kota lagi. Meskipun begitu, dari _requirement_ yang dibutuhkan ini sebenarnya tidak terlalu  diperlukan untuk menghubungkan  jabatan dengan unit kerja. apalagi hal ini mempersulit alur dari suatu database ini. Maka dari itu, dari _requirement_ yang ada unit kerja sebaiknya dihubungkan dengan tabel pegawai langsung.<br>
## Autentikasi
Untuk autentikasi dilakukan menggunakan library sanctum untuk mempermudah mendapatkan suatu token. Token ini akan diverifikasi berdasarkan enum ability yang akan diberikan. Lalu akan dipasang sebagai middleware user melakukan autentikasi dengan akun apa dan rutenya ini akan berdasarkan token tersebut.
```php
enum TokenAbility: string
{
    case ACCESS_GUEST= 'access-guest';
    case ACCESS_ADMIN = 'access-admin';

}
```
Lalu untuk autentikasi ini terdapat dua akses yang akan dilakukan yaitu Admin dan Guest. Cara kerja guest ini adalah akan dipasang dalam front-end untuk identitas yang unik berbentuk _web fingerprint_ yang dimana web fingerprint ini akan dipakai untuk autentikasi dan didapatkan token untuk mengakses rute. Lalu untuk admin hanya terdapat username dan password (`username : admin`  `password admin`) admin ini hanya bisa dipakai oleh satu akun yang bisa mengakses untuk mengubah data yang ada.

## Fitur
Dari requirement yang ada dibuatlah rute seperti berikut
```
Route::controller(AuthController::class)->group(function(){
    Route::post('login', 'loginAdmin');
    Route::post('loginGuest', 'loginGuest');
});
Route::middleware('auth:sanctum')->group(function(){
    Route::prefix('pegawai')->group(function(){
        Route::controller(PegawaiController::class)->group(function(){
            Route::get( '/', 'GetAllPegawai');
            Route::get('/filter/','GetPegawaibyFilter');
        });
        Route::controller(UnitKerjaController::class)->group(function(){
            Route::get('/unitkerja', 'GetAllUnitKerja');
        });
        Route::controller(JabatanController::class)->group(function(){
           Route::get('/jabatan', 'GetAllJabatan');
           Route::post('/jabatan', 'PostJabatan');
        });
        Route::controller(WilayahController::class)->group(function(){
            Route::get('/provinsi', 'GetAllProvinsi');
            Route::get('/kota', 'GetAllKota');
        });
    });
    Route::middleware('ability:' . TokenAbility::ACCESS_ADMIN->value)->group(function(){
        Route::prefix('pegawai')->group(function(){
            Route::controller(PegawaiController::class)->group(function(){
                Route::post('/', 'CreatePegawai');
                Route::put('/{NIP}', 'UpdatePegawai');
                Route::delete('/{NIP}', 'DeletePegawai');
            });
        });
    });
});
```



