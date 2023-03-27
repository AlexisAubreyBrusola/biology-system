<?php
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
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
}
