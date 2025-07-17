studi kasus : 
Saya ingin membuat mvp aplikasi web CRUD menggunakan Laravel dengan judul Data Customer & Transaksi Zkeys Workshop Keyboard Builder. Waktu pembuatan aplikasi yaitu 2 minggu. Jumlah actor yaitu 1. Buatkan daftar alur kerja dan fitur yang harus saya buat beserta deskripsinya.

nama database : zkeys


CREATE TABLE customers (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(20) NOT NULL,
    address TEXT NOT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);


CREATE TABLE transactions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    customer_id BIGINT UNSIGNED NOT NULL,
    transaction_date DATE NOT NULL,
    service_type VARCHAR(100) NOT NULL,
    price INT NOT NULL,
    status ENUM('Pending', 'Selesai', 'Batal') DEFAULT 'Pending',
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,

    CONSTRAINT fk_customer FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE
);


CREATE TABLE admin (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);



susunan folder dan file : 
zkeys-workshop/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/               # Otentikasi (dari Breeze)
│   │   │   ├── CustomerController.php
│   │   │   ├── TransactionController.php
│   │   │   └── DashboardController.php
│   │   └── Middleware/
│
├── database/
│   ├── migrations/
│   │   ├── xxxx_create_customers_table.php
│   │   └── xxxx_create_transactions_table.php
│   └── seeders/
│
├── resources/
│   └── views/
│       ├── dashboard.blade.php
│       ├── customers/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   └── show.blade.php (opsional)
│       ├── transactions/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   └── show.blade.php
│       └── layouts/
│           └── app.blade.php       # Layout utama (bawaan Breeze)
│
├── routes/
│   └── web.php                     # Definisi route aplikasi
│
└── public/
    └── css/, js/                  # Asset frontend (Tailwind dari Breeze)


Fitur Minimum yang Wajib Ada:
Desain antarmuka responsif menggunakan framework CSS (Bootstrap atau Tailwind CSS)
Implementasi fungsi CRUD secara lengkap menggunakan Laravel
Fitur pencarian data
Validasi input pada form

Teknologi yang Digunakan:
Laravel (framework PHP)
Bootstrap atau Tailwind CSS (pilih salah satu)
MySQL (sebagai basis data)
Livewire atau Alpine.js (opsional, sesuai kebutuhan pengembangan)