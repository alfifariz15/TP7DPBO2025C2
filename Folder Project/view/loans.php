<?php
require_once 'class/Loan.php';
require_once 'class/Student.php';
require_once 'class/Equipment.php';

$database = new Database();
$db = $database->getConnection();

$loan = new Loan($db);
$student = new Student($db);
$equipment = new Equipment($db);

// Proses tambah pinjaman
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_POST['student_id'];
    $equipment_id = $_POST['equipment_id'];
    $loan_date = $_POST['loan_date'];
    $return_date = $_POST['return_date'];

    $loan->create($student_id, $equipment_id, $loan_date, $return_date);

    header("Location: index.php?page=loans");
    exit;
}

// Hapus data
if (isset($_GET['delete'])) {
    $loan->delete($_GET['delete']);
    header("Location: index.php?page=loans");
    exit;
}

// Ambil semua data
$data = $loan->getAll();
$students = $student->getAll();
$equipments = $equipment->getAll();
?>

<h2>Data Peminjaman</h2>

<form method="POST" style="margin-bottom:20px;">
    <select name="student_id" required>
        <option value="">-- Pilih Mahasiswa --</option>
        <?php while ($s = $students->fetch(PDO::FETCH_ASSOC)) { ?>
            <option value="<?= $s['id'] ?>"><?= $s['name'] ?></option>
        <?php } ?>
    </select>

    <select name="equipment_id" required>
        <option value="">-- Pilih Alat --</option>
        <?php while ($e = $equipments->fetch(PDO::FETCH_ASSOC)) { ?>
            <option value="<?= $e['id'] ?>"><?= $e['name'] ?></option>
        <?php } ?>
    </select>

    <input type="date" name="loan_date" id="loan_date" required>
    <input type="date" name="return_date" id="return_date" required>
    <button type="submit">Simpan</button>
</form>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Mahasiswa</th>
        <th>Alat</th>
        <th>Tgl Pinjam</th>
        <th>Tgl Kembali</th>
        <th>Aksi</th>
    </tr>
    <?php
    $no = 1;
    while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
            <td>{$no}</td>
            <td>{$row['student_name']}</td>
            <td>{$row['equipment_name']}</td>
            <td>{$row['loan_date']}</td>
            <td>{$row['return_date']}</td>
            <td>
                <a href='index.php?page=loans&delete={$row['id']}' onclick=\"return confirm('Hapus data ini?')\">Hapus</a>
            </td>
        </tr>";
        $no++;
    }
    ?>
</table>
