<?php
class EquipmentCodeGenerator {
    private $category;
    private $numberOfEquipment;

    public function __construct($category, $numberOfEquipment) {
        $this->category = $category;
        $this->numberOfEquipment = $numberOfEquipment;
    }

    // Generate one equipment code
    public function generateCode($specificNumber) {
        // Category
        $category = $this->category;
        // Get the last two digits of the year
        $yearCode = substr(date("Y"), -2);
        // Ensure the total number is three digits with leading zeros if necessary
        $totalNumberCode = str_pad($this->numberOfEquipment, 3, "0", STR_PAD_LEFT);
        // Ensure the specific number is three digits with leading zeros if necessary
        $specificNumberCode = str_pad($specificNumber, 3, "0", STR_PAD_LEFT);
        // Concatenate the codes to form the unique code
        $code = $category . "-" . $yearCode . $totalNumberCode . $specificNumberCode;
        return $code;
    }
}    
