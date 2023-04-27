<?php
class ChemicalModel {
    private $db;

    public function __construct(DbConn $db) {
        $this->db = $db;
    }

    public function addChemical($chemicalName, $container, $chemicalFormula, $description, $expirationDate, $dateAcquired, $status_id, $photoPath) {
        $sql = "INSERT INTO chemical (chemical_name, container, chemical_formula, description, expiration_date, date_acquired, status_id, photo) VALUES (:chemical_name, :container, :chemical_formula, :description, :expiration_date, :date_acquired, :status_id, :photo)";
        $this->db->query($sql);
        $this->db->bind(':chemical_name', $chemicalName);
        $this->db->bind(':container', $container);
        $this->db->bind(':chemical_formula', $chemicalFormula);
        $this->db->bind(':description', $description);
        $this->db->bind(':expiration_date', $expirationDate);
        $this->db->bind(':date_acquired', $dateAcquired);
        $this->db->bind(':status_id', $status_id);
        $this->db->bind(':photo', $photoPath);

        try {
            if($this->db->execute()) {
                return true;
            } else {
                throw new Exception("Failed to add Chemical.");
            }
        } catch (PDOException $e) {
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public function addChemicalToInventory($chemicalId, $container, $containerMaxQuantity, $chemicalQuantity) {
        $sql = "INSERT INTO chemical_inventory (chemical_id, container, maximum_quantity, available_quantity) VALUE (:chemical_id, :container, :maximum_quantity, :available_quantity)";
        $this->db->query($sql);
        $this->db->bind(':chemical_id', $chemicalId);
        $this->db->bind(':container', $container);
        $this->db->bind(':maximum_quantity', $containerMaxQuantity);
        $this->db->bind(':available_quantity', $chemicalQuantity);

        try {
            if($this->db->execute()) {
                return true;
            } else {
                throw new Exception("Failed to inventorize chemical.");
            }
        } catch (PDOException $e) {
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
    public function getChemicalById($chemicalId) {
        $sql = "SELECT * FROM chemical WHERE chemical_id = :chemical_id";
        $this->db->query($sql);
        $this->db->bind(":chemical_id", $chemicalId);
        try {
            $chemical = $this->db->single();
        } catch (PDOException $e) {
            // Handle the database error
            error_log("Database error: " . $e->getMessage());
            return null;
        }
        return $chemical;
    }

    public function getChemicalByContainer($chemicalContainer) {
        $sql = "SELECT * FROM chemical WHERE container = :container";
        $this->db->query($sql);
        $this->db->bind(":container", $chemicalContainer);
        try {
            $chemical = $this->db->single();
        } catch (PDOException $e) {
            // Handle the database error
            error_log("Database error: " . $e->getMessage());
            return null;
        }
        return $chemical;
    }

    public function getChemicalIdByNameAndContainer($chemicalName, $chemicalContainer) {
        $sql = "SELECT chemical_id FROM chemical WHERE chemical_name = :chemical_name AND container = :container";
        $this->db->query($sql);
        $this->db->bind(":chemical_name", $chemicalName);
        $this->db->bind(":container", $chemicalContainer);
        try {
            $result = $this->db->single();
            if ($result) {
                return $result['chemical_id'];
            } else {
                return null;
            }
        } catch (PDOException $e) {
            // Handle the database error
            error_log("Database error: " . $e->getMessage());
            return null;
        }
    }
    
    public function getChemicalInInventory($chemicalId, $container) {
        $sql = "SELECT * FROM chemical_inventory WHERE chemical_id = :chemical_id AND container = :container";
        $this->db->query($sql);
        $this->db->bind(":chemical_id", $chemicalId);
        $this->db->bind(":container", $container);
        try {
            $chemical = $this->db->single();
        } catch (PDOException $e) {
            // Handle the database error
            error_log("Database error: " . $e->getMessage());
            return null;
        }
        return $chemical;
    }
}