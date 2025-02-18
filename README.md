# How To Setup and Running The Project

## Syarat awal

Pastikan Anda telah menginstal:
- [PHP](https://www.php.net/) (versi sesuai dengan Laravel)
- [Composer](https://getcomposer.org/)
- [PostgreSQL](https://www.postgresql.org/)
- [Git](https://git-scm.com/)

## Instalasi

1. Clone repository ini:
   ```sh
   git clone https://github.com/randaru9/Tes-Tehnikal-API-FAN.git
   cd  Tes-Tehnikal-API-FAN/
   ```

2. Install dependency Laravel:
   ```sh
   composer install
   ```

3. Copy file `.env.example` menjadi `.env`:
   ```sh
   cp .env.example .env
   ```

4. Generate application key:
   ```sh
   php artisan key:generate
   ```

5. Generate jwt secret:
   ```sh
   php artisan jwt:secret
   ```

## Database Setup

1. Buat database PostgreSQL baru.
2. Edit file `.env` dan sesuaikan konfigurasi database:
   ```env
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=tes_tehnikal_api_fan
   DB_USERNAME=your_database_user
   DB_PASSWORD=your_database_password
   ```
3. Jalankan migrasi dan seeder database:
   ```sh
   php artisan migrate --seed
   ```

## Running the Project

1. Jalankan server backend:
   ```sh
   php artisan serve
   ```
2. Hit API menggunakan aplikasi seperti postman, untuk request dan response dapat dilihat dibawah

## Request dan Response

1. Login
   \
   Request :
   ```sh
   Route : /api/auth/login
   Method : POST
   Body : {"email", "password"}
   ```
   Response :
   ```sh
    "statusCode": 200,
    "message": "Login berhasil",
    "data": {
        "token": "",
        "exp": ""
    }
   ```
   Screenshot:
   ![postman login](/Screenshot/Login.jpeg)

2. Insert Data
   \
   Request :
   ```sh
   Route : /api/epresence/create
   Method : POST
   Authorization : {Bearer Token}
   Body : {"type", "waktu"}
   ```
   Response :
   ```sh
    "statusCode": 201,
    "message": "Buat Presensi Berhasil",
    "data": []
   ```
   Screenshot:
   ![postman insert data](/Screenshot/Insert%20Data.jpeg)
   
3. Approve Data
   \
   Request :
   ```sh
   Route : /api/epresence/approve
   Method : PUT
   Authorization : {Bearer Token}
   Body : {"epresence_id"}
   ```
   Response :
   ```sh
    "statusCode": 200,
    "message": "Approve Presensi Berhasil",
    "data": []
   ```
   Screenshot:
   ![postman approve data](/Screenshot/Approve%20Data.jpeg)

5. Get Data
   \
   Request :
   ```sh
   Route : /api/epresence/get
   Method : GET
   Authorization : {Bearer Token}
   ```
   Response :
   ```sh
    "statusCode": 200,
    "message": "Berhasil get data absen",
    "data": [
        {
            "id_user": "",
            "nama_user": "",
            "tanggal": "",
            "waktu_masuk": "",
            "waktu_pulang": "",
            "status_masuk": "",
            "status_pulang": ""
        },
        {
            "id_user": "",
            "nama_user": "",
            "tanggal": "",
            "waktu_masuk": "",
            "waktu_pulang": "",
            "status_masuk": "",
            "status_pulang": ""
        },
    ]
   ```
   Screenshot:
   ![postman get data](/Screenshot/Get%20Data.jpeg)
   
