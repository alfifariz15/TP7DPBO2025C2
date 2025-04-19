<?php
class Student {
    private $conn;
    private $table_name = "students";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY name ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create($name, $email, $phone) {
        $query = "INSERT INTO " . $this->table_name . " (name, email, phone) VALUES (:name, :email, :phone)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':name' => $name, ':email' => $email, ':phone' => $phone]);
    }

    public function update($id, $name, $email, $phone) {
        $query = "UPDATE " . $this->table_name . " SET name = :name, email = :email, phone = :phone WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':name' => $name, ':email' => $email, ':phone' => $phone, ':id' => $id]);
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':id' => $id]);
    }
}
?>
