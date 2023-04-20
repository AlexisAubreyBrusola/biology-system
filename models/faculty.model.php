<?php
class Faculty {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
    public function addFacultyInfo ($borrowerID, $faculty_id, $department) {
        $sql = "INSERT INTO faculty (borrower_id, faculty_id, department) VALUE (:borrower_id, :faculty_id, :department)";
        $this->db->query($sql);
        $this->db->bind(':borrower_id', $borrowerID);
        $this->db->bind(':faculty_id', $faculty_id);
        $this->db->bind(':department', $department);

        try {
            if($this->db->execute()) {
                return true;
            } else {
                throw new Exception("Failed to add faculty's information.");
            }
        } catch (PDOException $e) {
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
}