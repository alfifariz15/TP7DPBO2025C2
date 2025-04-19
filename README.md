# TP7DPBO2025C2
Saya Muhammad Alfi Fariz dengan NIM 2311174 mengerjakan TP 7 dalam mata kuliah Desain Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

# Desain Program
![Screenshot 2025-04-20 001335](https://github.com/user-attachments/assets/30c75739-12d8-4999-ab3b-42a1e2ee9239)

Disini saya membuat web sederhana tentang Sistem Peminjaman Alat Olahraga untuk struktur tabel nya seperti ini

a. equipment (alat olahraga)
- id (PK)
- name
- type
- stock

b. students (mahasiswa)
- id (PK)
- name
- email
- phone

c. loans (peminjaman alat)
- id (PK)
- equipment_id (FK → equipment.id)
- student_id (FK → students.id)
- loan_date
- return_date

# Penjelasan Alur Program
a. Routing via index.php

File ini menangani navigasi antar halaman berdasarkan query ?page=xxx.

Ketika kamu buka index.php?page=loans, maka loans.php di-load.

b. Form Peminjaman (loans.php)
Menampilkan form untuk memilih:
- Mahasiswa (student_id)
- Alat (equipment_id)
- Tanggal pinjam (loan_date)
- Tanggal kembali (return_date)

c. Kelas Loan.php
Model yang menangani operasi CRUD data peminjaman:
- Method getAll() → mengambil data semua peminjaman.
- Method delete() → hapus berdasarkan ID.

d. Data Ditampilkan Dalam Tabel
Setelah data diproses, semua pinjaman ditampilkan dalam bentuk tabel

e. Koneksi Database (db.php)
Menyiapkan koneksi dengan database menggunakan PDO.

f. Singkatnya, Alur Peminjaman:

1. User buka index.php?page=loans

2. Pilih mahasiswa, alat, dan tanggal pinjam & kembali

3. Submit → data dikirim via POST ke file yang sama

4. Loan.php menyimpan data ke database

5. Redirect kembali ke halaman loans

6. Data pinjaman ditampilkan di tabel

# ScreenRecord Program
https://github.com/user-attachments/assets/92d56f63-93a3-46f4-8e02-161749ca5910

