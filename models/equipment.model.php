<?php
class EquipmentModel {
    private $db;

    public function __construct(DbConn $db) {
        $this->db = $db;
    }

    public function addEquipment($equipmentCode, $equipmentName, $categoryId, $description, $statusId, $photoPath) {
        $sql = "INSERT INTO equipment (equipment_code, equipment_name, category_id, description, status_id, photo) VALUES (:equipment_code, :equipment_name, :category_id, :description, :status_id, :photo)";
        $this->db->query($sql);
        $this->db->bind(':equipment_code', $equipmentCode);
        $this->db->bind(':equipment_name', $equipmentName);
        $this->db->bind(':category_id', $categoryId);
        $this->db->bind(':description', $description);
        $this->db->bind(':status_id', $statusId);
        $this->db->bind(':photo', $photoPath);

        try {
            if($this->db->execute()) {
                return true;
            } else {
                throw new Exception("Failed to add equipment.");
            }
        } catch (PDOException $e) {
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public function getEquipmentCode($equipmentCode) {
        $sql = "SELECT * FROM equipment WHERE equipment_code = :equipmentCode";
        $this->db->query($sql);
        $this->db->bind(":equipmentCode", $equipmentCode);
        try {
            $equipmentCode = $this->db->resultSet();
        } catch (PDOException $e) {
            // Handle the database error
            error_log("Database error: " . $e->getMessage());
            return null;
        }
        return $equipmentCode;
    }

    public function getSimilarEquipmentCode($equipmentCategory) {
        $currentYear = substr(date('Y'), 0, 2);
        $similarEquipment = $equipmentCategory. '-' . "$currentYear" . '%';
        $sql = "SELECT equipment_code FROM equipment WHERE equipment_code LIKE '$equipmentCategory";
        $this->db->query($sql);
        $this->db->query($sql);
    }
}
