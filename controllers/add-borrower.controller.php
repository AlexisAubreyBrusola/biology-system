<?php
require_once '../models/user.model.php';
class AddBorrower {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function addBorrowerController($firstname, $lastname, $email, $password, $user_type_id, $contact_no) {
        $result = $this->model->addBorrower($firstname, $lastname, $email, $password, $user_type_id, $contact_no);
        if($result) {
            $message = 'Borrower successfully added!';
            return true;
        } else {
            $message = 'Failed to add borrower.';
            return false;
        }

    }
}