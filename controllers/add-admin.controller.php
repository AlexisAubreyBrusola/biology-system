<?php
class AddAdminController {
    private $model;
    public function __construct($model) {
        $this->model = $model;
    }
    
    public function addAdminController($firstname, $lastname, $email, $password, $confirm_password) {
        // Validate inputs
        if(empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($confirm_password)) {
            return false;
        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        } elseif(strlen($password) < 8) {
            return false;
        } elseif($password !== $confirm_password) {
            return false;
        } else {
            // Add admin
            $result = $this->model->addAdmin($firstname, $lastname, $email, $password);
            if($result) {
                return true;
            } else {
                return false;
            }
        }
    }
}