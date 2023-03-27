<?php
   class Login {
        private $db;
        public function __construct() {
            $this->db = new DbConn;
        }

        // Login for Admin
        public function adminLogin($email, $password) {
            $sql = "SELECT * FROM admin WHERE email = :email";
            $this->db->query($sql);
            $this->db->bind(":email", $email);
            $user = $this->db->single();

            // Check if the user exists
            if ($this->db->rowCount() > 0) {
                // Verify password
                if(password_verify($password, $user['password'])) {
                    // Set SESSION variables
                    $_SESSION['admin_id'] = $user['admin_id'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['name'] = $user['firstname'] . ' ' . $user['lastname'];
                    return true;
                } else {
                    // Incorrect Password
                    return false;
                }
            } else {
                // User not found
                return false;
            }
        }

        public function logoutAdmin() {
            // Unset or remove session variables
            unset($_SESSION['user_id']);
            unset($_SESSION['user_email']);
            unset($_SESSION['name']);
        }

        public function adminIsLoggedIn() {
            // Check if borrower is logged in
            if(isset($_SESSION['user_id'])) {
              return true;
            } else {
              return false;
            }
        }

        // Login for Borrower
        public function borrowerLogin($email, $password) {
            $sql = "SELECT * FROM users WHERE email = :email";
            $this->db->query($sql);
            $this->db->bind(":email", $email);
            $user = $this->db->single();

            // Check if the user exists
            if ($this->db->rowCount() > 0) {
                // Verify password
                if(password_verify($password, $user['password'])) {
                    // Set SESSION variables
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['user_email'] = $user['email'];
                    $_SESSION['name'] = $user['firstname'] . ' ' . $user['lastname'];
                    return true;
                } else {
                    // Incorrect Password
                    return false;
                }
            } else {
                // User not found
                return false;
            }
        }

        public function logoutBorrower() {
            // Unset or remove session variables
            unset($_SESSION['user_id']);
            unset($_SESSION['user_email']);
            unset($_SESSION['name']);
        }

        public function borrowerIsLoggedIn() {
            // Check if borrower is logged in
            if(isset($_SESSION['user_id'])) {
              return true;
            } else {
              return false;
            }
        }
    }