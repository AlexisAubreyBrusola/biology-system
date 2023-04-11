<?php
class Login {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    // Login for Admin
    public function adminLogin($email, $password) {
        $admin = $this->model->getAdminByEmail($email);
        // Check if the user exists
        if ($admin) {           
            // Verify password
            if(password_verify($password, $admin['password'])) {
                // Set SESSION variables
                $_SESSION['admin_id'] = $admin['admin_id'];
                $_SESSION['admin_email'] = $admin['email'];
                $_SESSION['admin_firstname'] = $admin['firstname'];
                $_SESSION['admin_lastname'] = $admin['lastname'];
                $_SESSION['user_type'] = 'admin';
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

    // Get admin name by admin id
    public function getAdminName() {
        if (isset($_SESSION['admin_id'])) {
            $adminId = $_SESSION['admin_id'];
            $admin = $this->model->getAdminById($adminId);
            return $admin['firstname'] . ' ' . $admin['lastname'];
        } else {
            return null;
        }
    }

    public function logoutAdmin() {
        // Unset or remove session variables
        unset($_SESSION['admin_id']);
        unset($_SESSION['admin_email']);
        unset($_SESSION['admin_firstname']);
        unset($_SESSION['admin_lastname']);
        unset($_SESSION['user_type']);
        session_destroy();
        header('Location: ../view/login.php');
    }

    public function borrowerLogin($email, $password) {
        $borrower = $this->model->getBorrowerByEmail($email);
        // Check if the user exists
        if ($borrower) {           
            // Verify password
            if(password_verify($password, $borrower['password'])) {
                // Set SESSION variables
                $_SESSION['borrower_id'] = $borrower['user_id'];
                $_SESSION['borrower_email'] = $borrower['email'];
                $_SESSION['borrower_firstname'] = $borrower['firstname'];
                $_SESSION['borrower_lastname'] = $borrower['lastname'];
                $_SESSION['borrower_type'] = $borrower['user_type_id'];
                $_SESSION['contact_no'] = $borrower['contact_no'];
                $_SESSION['user_type'] = 'borrower';
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
        unset($_SESSION['borrower_id']);
        unset($_SESSION['borrower_email']);
        unset($_SESSION['borrower_firstname']);
        unset($_SESSION['borrower_lastname']);
        unset($_SESSION['borrower_type']);
        unset($_SESSION['contact_no']);
        unset($_SESSION['user_type']);
        session_destroy();
        header('Location: ../view/login.php');
    }
}