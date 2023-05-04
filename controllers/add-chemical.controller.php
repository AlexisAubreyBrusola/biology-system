<?php
class AddChemicalController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function addChemicalController($chemicalName, $container, $containerMaxQuantity, $chemicalQuantity, $description, $expirationDate, $dateAcquired, $fileSize, $imagePath = "Not Specified", $chemicalFormula = "Not specified", $status_id = 1, $times_borrowed = 0) {

        if(empty($chemicalName) || empty($container) || empty($containerMaxQuantity) || empty($chemicalQuantity)) {
            return [false, 'This fields are required. Please fill up the fields.'];
        } elseif($container < 1) {
            return [false, "The container should be a positive number!"];
        } elseif($chemicalQuantity > $containerMaxQuantity) {
            return [false, "Failed to add Chemical to the database. Chemical's should be equal to the Container's maximum quantity"];
        } elseif($fileSize > 2097152){
            return [false, 'The file size of the image is too large. Size of the image should not exceed 2.0MB. Failed to add equipment!'];
        } else {
            $existingChemicalContainer = $this->model->getChemicalIdByNameAndContainer($chemicalName, $container);
            if($existingChemicalContainer) {
                return [false, "This chemical's container already exists. Please just put the chemical in to its intended container"];
            } else {
                $chemical = $this->model->addChemical($chemicalName, $container, $chemicalFormula, $description, $expirationDate, $dateAcquired, $status_id, $imagePath);

                if($chemical) {
                    $chemicalId = $this->model->getChemicalIdByNameAndContainer($chemicalName, $container);
                    $chemicalAlreadyInInventory = $this->model->getChemicalInInventory($chemicalId, $container);

                    if($chemicalAlreadyInInventory) {
                        return [false, "This chemical is already in inventory!"];
                    } else {
                        $addChemicalToInventory = $this->model->addChemicalToInventory($chemicalId, $container, $containerMaxQuantity, $chemicalQuantity);

                        if($addChemicalToInventory) {
                            return [true, "Chemical is successfully added in the inventory!"];
                        } else {
                            return [false, "Failed to add chemical in inventory!"];
                        }
                    }
                }
            }
        }
    }

    public function getChemicalImageFilePath($fileSize, $filePath, $tempFileName, $fileName, $uploadError) {
        $sizeInKB = $fileSize/1024;
        $formattedSize = number_format($sizeInKB, 2);
        if($formattedSize > 2048) {
            return [false, "The file size of the image is too large. Size of the image should not exceed 2.0MB"];
        } elseif(empty($tempFileName)) {
            return [false, "There is no image uploaded. Please upload an image"];
        } else {
            $newFilePath = $filePath . '/' . str_replace(array('\\', '/', ' ', "'", ':', '|', '*', '<', '>', '?', '"'), '', $fileName);
            if(move_uploaded_file($tempFileName, $newFilePath)) {
                return $fileName;
            } else {
                return [false, "Upload error: $uploadError"];
            }
        }
    }
}