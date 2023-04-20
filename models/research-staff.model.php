<?php
class ResearchStaff {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
    public function addResearchStaffInfo ($borrowerID, $research_staff_id) {
        $sql = "INSERT INTO research_staff (borrower_id, research_staff_id) VALUE (:borrower_id, :research_staff_id)";
        $this->db->query($sql);
        $this->db->bind(':borrower_id', $borrowerID);
        $this->db->bind(':research_staff_id', $research_staff_id);

        try {
            if($this->db->execute()) {
                return true;
            } else {
                throw new Exception("Failed to add research staff's information.");
            }
        } catch (PDOException $e) {
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
}