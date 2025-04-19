<?php
class Loan {
    private $conn;
    private $table_name = "loans";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT loans.*, students.name AS student_name, equipment.name AS equipment_name 
                  FROM " . $this->table_name . "
                  JOIN students ON loans.student_id = students.id
                  JOIN equipment ON loans.equipment_id = equipment.id
                  ORDER BY loan_date DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create($equipment_id, $student_id, $loan_date, $return_date) {
        $query = "INSERT INTO " . $this->table_name . " (equipment_id, student_id, loan_date, return_date) 
                  VALUES (:equipment_id, :student_id, :loan_date, :return_date)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':equipment_id' => $equipment_id,
            ':student_id' => $student_id,
            ':loan_date' => $loan_date,
            ':return_date' => $return_date
        ]);
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':id' => $id]);
    }
}
?>