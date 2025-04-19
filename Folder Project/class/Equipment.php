<?php
class Equipment {
    private $conn;
    private $table_name = "equipment";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY name ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function search($keyword) {
        $query = "SELECT * FROM " . $this->table_name . " 
                  WHERE name LIKE :keyword 
                  ORDER BY name ASC";
        $stmt = $this->conn->prepare($query);
        $keyword = "%{$keyword}%";
        $stmt->bindParam(':keyword', $keyword);
        $stmt->execute();
        return $stmt;
    }
    

    public function create($name, $type, $stock) {
        $query = "INSERT INTO " . $this->table_name . " (name, type, stock) VALUES (:name, :type, :stock)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':name' => $name, ':type' => $type, ':stock' => $stock]);
    }

    public function update($id, $name, $type, $stock) {
        $query = "UPDATE " . $this->table_name . " SET name = :name, type = :type, stock = :stock WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':name' => $name, ':type' => $type, ':stock' => $stock, ':id' => $id]);
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':id' => $id]);
    }
}
?>
