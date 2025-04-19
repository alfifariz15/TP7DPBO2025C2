<?php
require_once 'class/Student.php';
$database = new Database();
$db = $database->getConnection();
$student = new Student($db);

// Tambah / Edit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? '';
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    if ($id) {
        $student->update($id, $name, $email, $phone);
    } else {
        $student->create($name, $email, $phone);
    }

    header("Location: index.php?page=students");
    exit;
}

// Hapus data
if (isset($_GET['delete'])) {
    $student->delete($_GET['delete']);
    header("Location: index.php?page=students");
    exit;
}

// Ambil semua data mahasiswa
$data = $student->getAll();
?>

<h2>Data Mahasiswa</h2>

<form method="POST" style="margin-bottom:20px;">
    <input type="hidden" name="id" value="<?= $_GET['edit'] ?? '' ?>">

    <input type="text" name="name" placeholder="Nama" required value="<?= $_GET['name'] ?? '' ?>">
    <input type="email" name="email" placeholder="Email" required value="<?= $_GET['email'] ?? '' ?>">
    <input type="text" name="phone" placeholder="Telepon" required value="<?= $_GET['phone'] ?? '' ?>">

    <button type="submit">Simpan</button>
</form>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Telepon</th>
        <th>Aksi</th>
    </tr>
    <?php
    $no = 1;
    while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
                <td>{$no}</td>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['phone']}</td>
                <td>
                    <a href='index.php?page=students&edit={$row['id']}&name={$row['name']}&email={$row['email']}&phone={$row['phone']}'>Edit</a> |
                    <a href='index.php?page=students&delete={$row['id']}' onclick=\"return confirm('Hapus data ini?')\">Hapus</a>
                </td>
            </tr>";
        $no++;
    }
    ?>
</table>
