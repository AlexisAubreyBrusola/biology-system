<?php
class DropDownOptionModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // FETCH all borrower type
    public function getAllBorrowerType() {
        $sql = "SELECT * FROM borrower_type ORDER BY borrower_type_id";
        $this->db->query($sql);
        try{
            $results = $this->db->resultSet();
            return $results;
        } catch (PDOException $e) {
            // Handle the database error
            error_log("Database error: " . $e->getMessage());
            return null;
        }
    }
}