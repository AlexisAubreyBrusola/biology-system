<?php
class Student {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
    public function addStudentInfo ($borrowerID, $studentID, $course, $yearBlock) {
        $sql = "INSERT INTO student (borrower_id, course, year_block) VALUE (:borrower_id, :student_id, :course, :year_block)";
        $this->db->query($sql);
        $this->db->bind(':borrower_id', $borrowerID);
        $this->db->bind(':student_id', $studentID);
        $this->db->bind(':course', $course);
        $this->db->bind(':year_block', $yearBlock);

        try {
            if($this->db->execute()) {
                return true;
            } else {
                throw new Exception("Failed to add student information.");
            }
        } catch (PDOException $e) {
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
}