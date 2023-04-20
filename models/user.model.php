<?php
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    /***************************** Admin *******************************/

    // Add Admin
    public function addAdmin($firstname, $lastname, $email, $password) {
        $sql = "INSERT INTO admin (firstname, lastname, email, password) VALUES (:firstname, :lastname, :email, :password)";
        $this->db->query($sql);
        $this->db->bind(':firstname', $firstname);
        $this->db->bind(':lastname', $lastname);
        $this->db->bind(':email', $email);
        $this->db->bind(':password', password_hash($password, PASSWORD_DEFAULT));

        try {
            if($this->db->execute()) {
                return true;
            } else {
                throw new Exception("Failed to add admin.");
            }
        } catch (PDOException $e) {
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public function getAdminByEmail($email) {
        $sql = "SELECT * FROM admin WHERE email = :email";
        $this->db->query($sql);
        $this->db->bind(":email", $email);
        try {
            $admin = $this->db->single();
        } catch (PDOException $e) {
            // Handle the database error
            error_log("Database error: " . $e->getMessage());
            return null;
        }
        return $admin;
    }

    public function getAdminById($adminId) {
        $sql = "SELECT * FROM admin WHERE admin_id = :admin_id";
        $this->db->query($sql);
        $this->db->bind(":admin_id", $adminId);
        try {
            $admin = $this->db->single();
        } catch (PDOException $e) {
            // Handle the database error
            error_log("Database error: " . $e->getMessage());
            return null;
        }
        return $admin;
    }

    /***************************** Borrower *******************************/

    // Add Borrower/User
    public function addBorrower($firstname, $lastname, $email, $password, $borrower_type_id, $contact_no) {
        $sql = "INSERT INTO borrowers (firstname, lastname, email, password, borrower_type_id, contact_no) VALUES (:firstname, :lastname, :email, :password, :borrower_type_id, :contact_no)";
        $this->db->query($sql);
        $this->db->bind(':firstname', $firstname);
        $this->db->bind(':lastname', $lastname);
        $this->db->bind(':email', $email);
        $this->db->bind(':borrower_type_id', $borrower_type_id);
        $this->db->bind(':contact_no', $contact_no);
        $this->db->bind(':password', password_hash($password, PASSWORD_DEFAULT));

        try {
            if($this->db->execute()) {
                return true;
            } else {
                throw new Exception("Failed to add borrower.");
            }
        } catch (PDOException $e) {
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public function getBorrowerByEmail($email) {
        $sql = "SELECT * FROM borrowers WHERE email = :email";
        $this->db->query($sql);
        $this->db->bind(":email", $email);
        try {
            $admin = $this->db->single();
        } catch (PDOException $e) {
            // Handle the database error
            error_log("Database error: " . $e->getMessage());
            return null;
        }
        return $admin;
    }
    
    public function getBorrowerById($borrowerID) {
        $sql = "SELECT * FROM borrowers WHERE borrower_id = :borrower_id";
        $this->db->query($sql);
        $this->db->bind(":borrower_id", $borrowerID);
        try {
            $admin = $this->db->single();
        } catch (PDOException $e) {
            // Handle the database error
            error_log("Database error: " . $e->getMessage());
            return null;
        }
        return $admin;
    }

    public function getBorrowerIdByEmail($email) {
        $sql = "SELECT borrower_id FROM borrowers WHERE email = :email";
        $this->db->query($sql);
        $this->db->bind(":email", $email);
        try {
            $result = $this->db->single();
            return $result['borrower_id'];
        } catch (PDOException $e) {
            // Handle the database error
            error_log("Database error: " . $e->getMessage());
            return null;
        }
    }

    // Add Student Info
    public function addStudentInfo ($borrower_id, $student_id, $course, $year_block) {
        $sql = "INSERT INTO student (borrower_id, course, year_block) VALUE (:borrower_id, :student_id, :course, :year_block)";
        $this->db->query($sql);
        $this->db->bind(':borrower_id', $borrower_id);
        $this->db->bind(':student_id', $student_id);
        $this->db->bind(':course', $course);
        $this->db->bind(':year_block', $year_block);

        try {
            if($this->db->execute()) {
                return true;
            } else {
                throw new Exception("Failed to add student information.");
            }
        } catch (PDOException $e) {
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public function getStudentById ($student_id) {
        $sql = "SELECT * FROM student WHERE student_id = :student_id";
        $this->db->query($sql);
        $this->db->bind(":student_id", $student_id);
        try {
            $student = $this->db->single();
        } catch (PDOException $e) {
            // Handle the database error
            error_log("Database error: " . $e->getMessage());
            return null;
        }
        return $student;
    }

    // Add Faculty Info
    public function addFacultyInfo ($borrower_id, $faculty_id, $department) {
        $sql = "INSERT INTO faculty (borrower_id, faculty_id, department) VALUE (:borrower_id, :faculty_id, :faculty_id)";
        $this->db->query($sql);
        $this->db->bind(':borrower_id', $borrower_id);
        $this->db->bind(':faculty_id', $faculty_id);
        $this->db->bind(':department', $department);

        try {
            if($this->db->execute()) {
                return true;
            } else {
                throw new Exception("Failed to add faculty's information.");
            }
        } catch (PDOException $e) {
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public function getFacultyById ($faculty_id) {
        $sql = "SELECT * FROM faculty WHERE faculty_id = :faculty_id";
        $this->db->query($sql);
        $this->db->bind(":faculty_id", $faculty_id);
        try {
            $faculty = $this->db->single();
        } catch (PDOException $e) {
            // Handle the database error
            error_log("Database error: " . $e->getMessage());
            return null;
        }
        return $faculty;
    }

    // Add Research Staff Info
    public function addResearchStaffInfo ($borrower_id, $research_staff_id) {
        $sql = "INSERT INTO research_staff (borrower_id, research_staff_id) VALUE (:borrower_id, :research_staff_id)";
        $this->db->query($sql);
        $this->db->bind(':borrower_id', $borrower_id);
        $this->db->bind(':research_staff_id', $research_staff_id);

        try {
            if($this->db->execute()) {
                return true;
            } else {
                throw new Exception("Failed to add research staff's information.");
            }
        } catch (PDOException $e) {
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public function getResearchStaffById ($research_staff_id) {
        $sql = "SELECT * FROM research_staff WHERE research_staff = :research_staff_id";
        $this->db->query($sql);
        $this->db->bind(":research_staff_id", $research_staff_id);
        try {
            $research_staff = $this->db->single();
        } catch (PDOException $e) {
            // Handle the database error
            error_log("Database error: " . $e->getMessage());
            return null;
        }
        return $research_staff;
    }
}
