<?php

class AddEquipmentController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function addMultipleEquipment($equipmentName, $categoryId, $description, $fileSize, $numberOfUnits, $filePath, $tempFileName, $fileName, $uploadError, $statusId = 1, $timesBorrowed = 0) {
        if (empty($equipmentName) || empty($categoryId) || empty($description)) {
            return [false, 'Please fill-up all the fields'];
        } elseif ($fileSize > 2097152) {
            return [false, 'The file size of the image is too large. Size of the image should not exceed 2.0MB.'];
        } else {
            // Generate equipment code for each equipment
            $category = $this->model->getCategoryCode($categoryId);
            $photo = $this->getEquipmentImageFilePath($fileSize, $filePath, $tempFileName, $fileName, $uploadError);
            for ($i = 1; $i <= $numberOfUnits; $i++) {
                $equipmentNumber = $i;
                $equipmentCode = $this->generateEquipmentCode($category, $numberOfUnits, $equipmentNumber);
                $existingEquipmentCode = $this->model->getEquipmentCode($equipmentCode);
                if ($existingEquipmentCode) {
                    return [false, "Equipment with similar equipment code exists. Please review the equipment to be added."];
                } else {
                    $addEquipment = $this->model->addEquipment($equipmentCode, $equipmentName, $categoryId, $description, $photo, $statusId);
                    if (!$addEquipment) {
                        return [false, "Failed to add equipment. Please try again!"];
                    }
                }
            }
            return [true, "Successfully added equipment!"];
        }
    }  

    public function getEquipmentImageFilePath($fileSize, $filePath, $tempFileName, $fileName, $uploadError) {
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

    private function generateEquipmentCode($category, $numberOfUnits, $equipmentNumber) {
        // Convert year to 2-digit format
        $year = substr(strval(date('Y')), -2);

        // Generate unique number with leading zeros based on total number of units
        $uniqueNumber = str_pad($equipmentNumber, strlen(strval($numberOfUnits)), "0", STR_PAD_LEFT);

        // Combine category, year, and unique number to create equipment code
        $equipmentCode = $category . '-' . $year . str_pad($uniqueNumber, 2, "0", STR_PAD_LEFT) . str_pad($numberOfUnits, 2, "0", STR_PAD_LEFT);

        return $equipmentCode;
    }
}