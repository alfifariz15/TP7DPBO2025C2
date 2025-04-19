<?php
require_once 'class/Equipment.php';
$database = new Database();
$db = $database->getConnection();
$equipment = new Equipment($db);

// Tambah / Edit Data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? '';
    $name = $_POST['name'];
    $type = $_POST['type'];
    $stock = $_POST['stock'];

    if ($id) {
        $equipment->update($id, $name, $type, $stock);
    } else {
        $equipment->create($name, $type, $stock);
    }

    header("Location: index.php?page=equipment");
    exit;
}

// Hapus data
if (isset($_GET['delete'])) {
    $equipment->delete($_GET['delete']);
    header("Location: index.php?page=equipment");
    exit;
}

// Ambil semua data alat
$data = $equipment->getAll();
?>

<h2>Data Alat Olahraga</h2>

<form method="POST" style="margin-bottom:20px;">
    <input type="hidden" name="id" value="<?= $_GET['edit'] ?? '' ?>">

    <input type="text" name="name" placeholder="Nama Alat" required
        value="<?= $_GET['name'] ?? '' ?>">
    <input type="text" name="type" placeholder="Jenis" required
        value="<?= $_GET['type'] ?? '' ?>">
    <input type="number" name="stock" placeholder="Stok" required
        value="<?= $_GET['stock'] ?? '' ?>">

    <button type="submit">Simpan</button>
</form>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Jenis</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>
    <?php
    $no = 1;
    while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
                <td>{$no}</td>
                <td>{$row['name']}</td>
                <td>{$row['type']}</td>
                <td>{$row['stock']}</td>
                <td>
                    <a href='index.php?page=equipment&edit={$row['id']}&name={$row['name']}&type={$row['type']}&stock={$row['stock']}'>Edit</a> |
                    <a href='index.php?page=equipment&delete={$row['id']}' onclick=\"return confirm('Hapus data ini?')\">Hapus</a>
                </td>
            </tr>";
        $no++;
    }
    ?>
</table>
