<?php
class EquipmentModel {
    private $db;

    public function __construct(DbConn $db) {
        $this->db = $db;
    }

    public function addEquipment($equipmentCode, $equipmentName, $categoryId, $description, $photo, $statusId) {
        $sql = "INSERT INTO equipment (equipment_code, equipment_name, category_id, description, photo, status_id) VALUES (:equipment_code, :equipment_name, :category_id, :description, :photo, :status_id)";
        $this->db->query($sql);
        $this->db->bind(':equipment_code', $equipmentCode);
        $this->db->bind(':equipment_name', $equipmentName);
        $this->db->bind(':category_id', $categoryId);
        $this->db->bind(':description', $description);
        $this->db->bind(':photo', $photo);
        $this->db->bind(':status_id', $statusId);

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

    // Check and get if there are similar equipment codes
    public function getLatestSimilarEquipmentCode($equipmentCode) {
        $codeParts = explode("-", $equipmentCode);
        $categoryCode = $codeParts[0];
        $categoryYear = substr($codeParts[1], 0, 2);
        $similarCode = $categoryCode . "-" . $categoryYear;
        $sql = "SELECT * FROM equipment WHERE equipment_code LIKE :similarEquipmentCode ORDER BY equipment_code DESC LIMIT 1";
        $this->db->query($sql);
        $this->db->bind(":similarEquipmentCode", "{$similarCode}%");
        try {
            $latestEquipmentCode = $this->db->single();
            return $latestEquipmentCode;
        } catch (PDOException $e) {
            // Handle the database error
            error_log("Database error: " . $e->getMessage());
            return null;
        }
    }

    public function getEquipmentCode($equipmentCode) {
        $sql = "SELECT equipment_code FROM equipment WHERE equipment_code = :equipmentCode";
        $this->db->query($sql);
        $this->db->bind(":equipmentCode", $equipmentCode);
        try {
            $equipmentCode = $this->db->single();
            return $equipmentCode;
        } catch (PDOException $e) {
            // Handle the database error
            error_log("Database error: " . $e->getMessage());
            return null;
        }   
    }

    public function getCategoryCode($categoryId) {
        $sql = "SELECT category_code FROM equipment_category WHERE category_id = :category_id";
        $this->db->query($sql);
        $this->db->bind(":category_id", $categoryId);
        try {
            $result = $this->db->single();
            if ($result) {
                return $result['category_code'];
            } else {
                return null;
            }
        } catch (PDOException $e) {
            // Handle the database error
            error_log("Database error: " . $e->getMessage());
            return null;
        }
    }
}
