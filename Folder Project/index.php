<?php
// Koneksi database
require_once 'config/db.php';

// View header
include_once 'view/header.php';

// Routing berdasarkan parameter "page"
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {
    case 'equipment':
        include 'view/equipment.php';
        break;
    case 'students':
        include 'view/students.php';
        break;
    case 'loans':
        include 'view/loans.php';
        break;
    case 'search':
        include 'view/search.php';
        break;
    default:
        echo "<h2 style='text-align:center;'>Selamat datang di Sistem Peminjaman Alat Olahraga</h2>";
        break;
}

// View footer
include_once 'view/footer.php';
?>
