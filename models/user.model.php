<?php
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    /***************************** Admin *******************************/

    // Add Admin
    public function addAdmin($firstname, $lastname, $email, $password) {
        $sql = "INSERT INTO admin (firstname, lastname, email, password) VALUES (:firstname, :lastname, :email, :password)";
        $this->db->query($sql);
        $this->db->bind(':firstname', $firstname);
        $this->db->bind(':lastname', $lastname);
        $this->db->bind(':email', $email);
        $this->db->bind(':password', password_hash($password, PASSWORD_DEFAULT));

        try {
            if($this->db->execute()) {
                return true;
            } else {
                throw new Exception("Failed to add admin.");
            }
        } catch (PDOException $e) {
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public function getAdminByEmail($email) {
        $sql = "SELECT * FROM admin WHERE email = :email";
        $this->db->query($sql);
        $this->db->bind(":email", $email);
        try {
            $admin = $this->db->single();
        } catch (PDOException $e) {
            // Handle the database error
            error_log("Database error: " . $e->getMessage());
            return null;
        }
        return $admin;
    }

    public function getAdminById($adminId) {
        $sql = "SELECT * FROM admin WHERE admin_id = :admin_id";
        $this->db->query($sql);
        $this->db->bind(":admin_id", $adminId);
        try {
            $admin = $this->db->single();
        } catch (PDOException $e) {
            // Handle the database error
            error_log("Database error: " . $e->getMessage());
            return null;
        }
        return $admin;
    }

    /***************************** Borrower *******************************/

    // Add Borrower/User
    public function addBorrower($firstname, $lastname, $email, $password, $user_type_id, $contact_no) {
        $sql = "INSERT INTO admin (firstname, lastname, email, password, user_type_id, contact_no) VALUES (:firstname, :lastname, :email, :password, :user_type_id, :contact_no)";
        $this->db->query($sql);
        $this->db->bind(':firstname', $firstname);
        $this->db->bind(':lastname', $lastname);
        $this->db->bind(':email', $email);
        $this->db->bind(':user_type_id', $user_type_id);
        $this->db->bind(':contact_no', $contact_no);
        $this->db->bind(':password', password_hash($password, PASSWORD_DEFAULT));

        try {
            if($this->db->execute()) {
                return true;
            } else {
                throw new Exception("Failed to add admin.");
            }
        } catch (PDOException $e) {
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public function getBorrowerByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $this->db->query($sql);
        $this->db->bind(":email", $email);
        try {
            $admin = $this->db->single();
        } catch (PDOException $e) {
            // Handle the database error
            error_log("Database error: " . $e->getMessage());
            return null;
        }
        return $admin;
    }
    
    public function getBorrowerById($adminId) {
        $sql = "SELECT * FROM admin WHERE admin_id = :admin_id";
        $this->db->query($sql);
        $this->db->bind(":admin_id", $adminId);
        try {
            $admin = $this->db->single();
        } catch (PDOException $e) {
            // Handle the database error
            error_log("Database error: " . $e->getMessage());
            return null;
        }
        return $admin;
    }
}
