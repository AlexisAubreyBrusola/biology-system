<?php
class AddAdminController {
    private $model;
    public $message;
    public function __construct($model) {
        $this->model = $model;
    }
    
    public function addAdminController($firstname, $lastname, $email, $password, $confirm_password) {
        // Validate inputs
        // Validate inputs
        if(empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($confirm_password)) {
            return [false, "Please fill-up all the fields. Failed to add account!"];

        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return [false, "Please use a valid email. Failed to add account!"];

        } elseif(strlen($password) < 8) {
            return [false, "Password must be atleast 8 characters long. Failed to add account!"];

        } elseif($password !== $confirm_password) {
            return [false, "Password must match. Failed to add account!"];
        } else {
            // Check if email already exists
            $admin = $this->model->getAdminByEmail($email);
            if($admin) {
                return [false, "Email already exists. Failed to add account!"];
            } else {
                // Add admin
                $result = $this->model->addAdmin($firstname, $lastname, $email, $password);
                if($result) {
                    return [true, "Admin Account added successfully"];
                } else {
                    return [false, "There must be an error in the system, please try again."];
                }
            }
        }
    }
}