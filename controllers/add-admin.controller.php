<?php
class AddAdminController {
    private $model;
    public $message;
    public function __construct($model) {
        $this->model = $model;
    }
    
    public function addAdminController($firstname, $lastname, $email, $password, $confirm_password) {
        // Validate inputs
        if(empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($confirm_password)) {
            $message = "Please fill-up all the fields. Failed to add account!";
            return array(false, $message);
        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = "Please use a valid email. Failed to add account!";
            return array(false, $message);
        } elseif(strlen($password) < 8) {
            $message = "Password must be atleast 8 characters long. Failed to add account!";
            return array(false, $message);
        } elseif($password !== $confirm_password) {
            $message = "Password must match. Failed to add account! ";
            return array(false, $message);
        } else {
            // Check if email already exists
            $admin = $this->model->getAdminByEmail($email);
            if($admin) {
                $message = "Email already exists. Failed to add account!";
                return array(false, $message);
            }

            // Add admin
            $result = $this->model->addAdmin($firstname, $lastname, $email, $password);
            if($result) {
                $message = "Admin Account added successfully";
                return array(true, $message);
            } else {
                $message = "There must be an error in the system, please try again.";
                return array(false, $message);
            }
        }
    }
}