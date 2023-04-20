<?php
class AddBorrowerController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function addBorrowerController($firstname, $lastname, $email, $password, $confirm_password, $borrower_type_id, $contact_no) {

        // Validate inputs
        if(empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($confirm_password) || empty($contact_no) || empty($borrower_type_id)) {
            return [false, "Please fill-up all the fields. Failed to add account!"];

        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return [false, "Please use a valid email. Failed to add account!"];

        } elseif(strlen($password) < 8) {
            return [false, "Password must be atleast 8 characters long. Failed to add account!"];

        } elseif($password !== $confirm_password) {
            return [false, "Password must match. Failed to add account!"];
            
        } else {
            // Check if email already exists
            $existingBorrower = $this->model->getBorrowerByEmail($email);
            if($existingBorrower) {
                return [false, "Email already exists. Failed to add account!"];
            } else {
                // Add Borrower
                $borrower = $this->model->addBorrower($firstname, $lastname, $email, $password, $borrower_type_id, $contact_no);
                
                if($borrower) {
                    $borrower_id = $this->model->getBorrowerIdByEmail($email);

                    switch ($borrower_type_id) {
                        case 1: //STUDENT
                            $student_id = $_POST['student_id'];
                            $course = $_POST['course'];
                            $year_block = $_POST['year_block'];
                            $existingStudent = $this->model->getStudentById($student_id);

                            if ($existingStudent) {
                                return [false, "Student ID already belongs to an existing account"];
                            } else {
                                $result = $this->model->addStudentInfo($borrower_id, $student_id, $course, $year_block);
                                if ($result) {
                                    return [true, "Successfully added Student as borrower"];
                                } else {
                                    return [false, "There must be an error in the system, please try again."];
                                }
                            }
                        case 2: //FACULTY
                            $faculty_id = $_POST['faculty_id'];
                            $department = $_POST['department'];
                            $existingFaculty = $this->model->getFacultyById($faculty_id);
                            if ($existingFaculty) {
                                return [false, "Faculty ID already belongs to an existing account"];
                            } else {
                                $result = $this->model->addFacultyInfo($borrower_id, $faculty_id, $department);
                                if ($result) {
                                    return [true, "Successfully added Faculty as borrower"];
                                } else {
                                    return [false, "There must be an error in the system, please try again."];
                                }
                            }

                        case 3: //RESEARCH STAFF
                            $research_staff_id = $_POST['research_staff_id'];
                            $existingResearchStaff = $this->model->getResearchStaffById($research_staff_id);
                            if ($existingResearchStaff) {
                                return [false, "Research Staff ID already belongs to an existing account"];
                            } else {
                                $result = $this->model->addResearchStaffInfo($borrower_id, $research_staff_id);
                                if ($result) {
                                    return [true, "Successfully added Research Staff as borrower"];
                                } else {
                                    return [false, "There must be an error in the system, please try again."];
                                }     
                            } 
                        default:
                            return [false, "Invalid borrower type!"];
                    }
                } else {
                    return [false, "There must be an error in the system, please try again."];
                }
            }
        }
    }

    
}