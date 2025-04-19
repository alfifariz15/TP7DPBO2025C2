<?php
require_once 'class/Equipment.php';
$database = new Database();
$db = $database->getConnection();
$equipment = new Equipment($db);

// Cek apakah ada pencarian
$keyword = $_GET['keyword'] ?? '';
$data = $equipment->search($keyword);
?>

<h2>Pencarian Alat Olahraga</h2>

<form method="GET" action="index.php">
    <input type="hidden" name="page" value="search">
    <input type="text" name="keyword" placeholder="Cari nama alat..." value="<?= htmlspecialchars($keyword) ?>">
    <button type="submit">Cari</button>
</form>

<?php if ($data->rowCount() > 0) { ?>
    <table border="1" cellpadding="10" cellspacing="0" style="margin-top:15px;">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jenis</th>
            <th>Stok</th>
        </tr>
        <?php
        $no = 1;
        while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                <td>{$no}</td>
                <td>{$row['name']}</td>
                <td>{$row['type']}</td>
                <td>{$row['stock']}</td>
            </tr>";
            $no++;
        }
        ?>
    </table>
<?php } elseif ($keyword !== '') { ?>
    <p>Tidak ditemukan alat dengan nama <strong><?= htmlspecialchars($keyword) ?></strong>.</p>
<?php } ?>
