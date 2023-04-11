<?php
class DropdownOptionController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function showBorrowerTypes() {
        // Retrieve borrower types from the database
        $borrowerTypes = $this->model->getAllBorrowerType();
        return $borrowerTypes;
    }
}