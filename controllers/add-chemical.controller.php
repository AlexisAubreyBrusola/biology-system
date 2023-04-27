<?php
class AddChemicalController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function addChemicalController($chemicalName, $container, $containerMaxQuantity, $chemicalQuantity, $description, $expirationDate, $dateAcquired, $chemicalFormula = "Not specified", $status_id = 1, $photoPath = "Not specified", $times_borrowed = 0) {

        if(empty($chemicalName) || empty($container) || empty($containerMaxQuantity) || empty($chemicalQuantity)) {
            return [false, 'This fields are required. Please fill up the fields.'];
        } elseif($container < 1) {
            return [false, "The container should be a positive number!"];
        } elseif($chemicalQuantity > $containerMaxQuantity) {
            return [false, "Failed to add Chemical to the database. Chemical's should be equal to the Container's maximum quantity"];
        } else {
            $existingChemicalContainer = $this->model->getChemicalIdByNameAndContainer($chemicalName, $container);
            if($existingChemicalContainer) {
                return [false, "This chemical's container already exists. Please just put the chemical in to its intended container"];
            } else {
                $chemical = $this->model->addChemical($chemicalName, $container, $chemicalFormula, $description, $expirationDate, $dateAcquired, $status_id, $photoPath);

                if($chemical) {
                    $chemicalId = $this->model->getChemicalIdByNameAndContainer($chemicalName, $container);
                    $chemicalAlreadyInInventory = $this->model->getChemicalInInventory($chemicalId, $container);

                    if($chemicalAlreadyInInventory) {
                        return [false, "This chemical is already Inventorized!"];
                    } else {
                        $addChemicalToInventory = $this->model->addChemicalToInventory($chemicalId, $container, $containerMaxQuantity, $chemicalQuantity);

                        if($addChemicalToInventory) {
                            return [true, "Chemical is Inventorized!"];
                        } else {
                            return [false, "Failed to inventorize chemical!"];
                        }
                    }
                }
            }
        }
    }
}