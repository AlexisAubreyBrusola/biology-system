<?php
class AddBorrowerController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function addBorrowerController($firstname, $lastname, $email, $password, $user_type_id, $contact_no) {
        // Validate inputs
        if(empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($user_type_id) || empty($contact_no)) {
            return false;
        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        } elseif(strlen($password) < 8) {
            return false;
        } else {
            $result = $this->model->addBorrower($firstname, $lastname, $email, $password, $user_type_id, $contact_no);
            if($result) {
                return true;
            } else {
                return false;
            }
        }
    }
}