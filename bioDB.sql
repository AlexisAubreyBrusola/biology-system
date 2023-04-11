/* PLEASE ENTER THIS QUERY TO HAVE A TEST ADMIN ACCOUNT 

INSERT INTO `admin` (`admin_id`, `firstname`, `lastname`, `email`, `password`, `date_created`) VALUES (NULL, 'Admin1', 'Lastname', 'admin@gmail.com', '$2y$10$jUeZKPpbIRtgTW326MkUP.snrERlCg.XissqJR33Q71eqrHEB7Ab.', current_timestamp());

*/


-- SEMESTER
CREATE TABLE IF NOT EXISTS semester (
    semester_id INT NOT NULL AUTO_INCREMENT,
    semester_name VARCHAR(255) NOT NULL UNIQUE,
    start_date DATETIME NOT NULL,
    end_date DATETIME NOT NULL,
    PRIMARY KEY (semester_id)
);
CREATE TABLE IF NOT EXISTS borrower_type (
    borrower_type_id int NOT NULL AUTO_INCREMENT,
    type_name varchar(100) NOT NULL UNIQUE,
    PRIMARY KEY (borrower_type_id)
);
-- BORROWERS
CREATE TABLE IF NOT EXISTS borrowers (
    borrower_id int NOT NULL AUTO_INCREMENT,
    borrower_type_id int NOT NULL,
    firstname varchar(100) NOT NULL,
    lastname varchar(100) NOT NULL,
    email varchar(255) NOT NULL UNIQUE,
    password varchar(255) NOT NULL,
    contact_no varchar(12),
    date_created DATETIME DEFAULT NOW(),
    PRIMARY KEY (borrower_id),
    FOREIGN KEY (borrower_type_id) REFERENCES borrower_type (borrower_type_id)
);
-- STUDENT
CREATE TABLE IF NOT EXISTS student (
    student_id VARCHAR(50) NOT NULL,
    borrower_id INT NOT NULL,
    course VARCHAR(255) NOT NULL,
    year_block VARCHAR(3) NOT NULL,
    PRIMARY KEY (student_id),
    FOREIGN KEY (borrower_id) REFERENCES borrowers (borrower_id)
);
-- RESEARCH STAFF
CREATE TABLE IF NOT EXISTS research_staff (
    research_staff_id VARCHAR(50) NOT NULL,
    borrower_id INT NOT NULL,
    PRIMARY KEY (research_staff_id),
    FOREIGN KEY (borrower_id) REFERENCES borrowers (borrower_id)
);
-- FACULTY
CREATE TABLE IF NOT EXISTS faculty (
    faculty_id VARCHAR(50) NOT NULL,
    borrower_id INT NOT NULL,
    PRIMARY KEY (faculty_id),
    FOREIGN KEY (borrower_id) REFERENCES borrowers (borrower_id)
);
-- ADMIN
CREATE TABLE IF NOT EXISTS admin (  
    admin_id INT NOT NULL AUTO_INCREMENT,
    firstname VARCHAR(255) NOT NULL UNIQUE,
    lastname VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    date_created DATETIME DEFAULT NOW(),
    PRIMARY KEY (admin_id)
);
-- STATUS (available, borrowed, broken, lost)
CREATE TABLE IF NOT EXISTS status_table (
    status_id INT AUTO_INCREMENT NOT NULL,
    status_name VARCHAR(50) NOT NULL UNIQUE,
    description VARCHAR(255),
    PRIMARY KEY (status_id)
);
-- EQUIPMENT CATEGORY
CREATE TABLE IF NOT EXISTS equipment_category (
    category_id INT AUTO_INCREMENT NOT NULL,
    category_name VARCHAR(255) NOT NULL,
    PRIMARY KEY (category_id)
);
-- EQUIPMENT
CREATE TABLE IF NOT EXISTS equipment (
    equipment_id INT NOT NULL AUTO_INCREMENT,
    equipment_code VARCHAR(50) NOT NULL UNIQUE,
    equipment_name VARCHAR(255) NOT NULL,
    category_id INT NOT NULL,
    description VARCHAR(255) NOT NULL,
    status_id INT NOT NULL,
    photo varchar(255),
    times_borrowed INT NOT NULL DEFAULT 0,
    date_added DATETIME NOT NULL DEFAULT NOW(),
    PRIMARY KEY (equipment_id),
    FOREIGN KEY (status_id) REFERENCES status_table (status_id)
);
-- EQUIPMENT INVENTORY
CREATE TABLE IF NOT EXISTS equipment_inventory (
    equipment_inventory_id INT AUTO_INCREMENT NOT NULL,
    equipment_name VARCHAR(255) NOT NULL,
    total_quantity INT NOT NULL DEFAULT 0,
    available_quantity INT NOT NULL DEFAULT 0,
    PRIMARY KEY (equipment_inventory_id)
);
-- CHEMICAL
CREATE TABLE IF NOT EXISTS chemical (
    chemical_id INT AUTO_INCREMENT NOT NULL,
    container INT NOT NULL,
    chemical_name VARCHAR(255) NOT NULL,
    chemical_formula VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    expiration_date DATETIME NOT NULL,
    date_acquired DATETIME,
    status_id INT NOT NULL,
    photo varchar(255),
    times_borrowed INT NOT NULL DEFAULT 0,
    date_added DATETIME NOT NULL DEFAULT NOW(),
    PRIMARY KEY (chemical_id, container),
    FOREIGN KEY (status_id) REFERENCES status_table (status_id)
);
-- CHEMICAL INVENTORY
CREATE TABLE IF NOT EXISTS chemical_inventory (
    chemical_inventory_id INT AUTO_INCREMENT NOT NULL,
    chemical_id INT NOT NULL,
    container INT NOT NULL,
    total_quantity INT NOT NULL DEFAULT 0,
    available_quantity INT NOT NULL DEFAULT 0,
    PRIMARY KEY (chemical_inventory_id),
    FOREIGN KEY (chemical_id, container) REFERENCES chemical (chemical_id, container)
);
-- BASKET AND BASKET INVENTORY
CREATE TABLE IF NOT EXISTS basket (
    basket_id INT NOT NULL AUTO_INCREMENT,
    color VARCHAR(50) NOT NULL,
    description VARCHAR(255) NOT NULL,
    date_acquired DATETIME,
    PRIMARY KEY (basket_id)
);
CREATE TABLE IF NOT EXISTS basket_inventory (
    basket_inventory_id INT NOT NULL AUTO_INCREMENT,
    total_quantity INT NOT NULL DEFAULT 0,
    available_quantity INT NOT NULL DEFAULT 0,
    PRIMARY KEY (basket_inventory_id)
);
-- RESERVATION
CREATE TABLE IF NOT EXISTS reservation (
    reservation_id INT NOT NULL AUTO_INCREMENT,
    reference_no VARCHAR(50) NOT NULL UNIQUE,
    borrower_id INT NOT NULL,
    faculty_id VARCHAR(50),
    admin_id INT NOT NULL,
    lab_experiment_title VARCHAR(255) NOT NULL,
    start_date DATETIME NOT NULL,
    return_date DATETIME NOT NULL,
    semester_id INT NOT NULL,
    PRIMARY KEY (reservation_id),
    FOREIGN KEY (borrower_id) REFERENCES borrowers (borrower_id),
    FOREIGN KEY (faculty_id) REFERENCES faculty (faculty_id),
    FOREIGN KEY (admin_id) REFERENCES admin (admin_id),
    FOREIGN KEY (semester_id) REFERENCES semester (semester_id)
);
-- GROUP MEMBERS
CREATE TABLE IF NOT EXISTS group_members (
    borrower_id INT NOT NULL,
    reservation_id INT NOT NULL,
    PRIMARY KEY (borrower_id),
    FOREIGN KEY (borrower_id) REFERENCES borrowers (borrower_id),
    FOREIGN KEY (reservation_id) REFERENCES reservation (reservation_id)
);
CREATE TABLE IF NOT EXISTS reservation_equipment (
    reservation_id INT NOT NULL,
    equipment_id INT NOT NULL UNIQUE,
    is_returned BOOLEAN NOT NULL DEFAULT false,
    date_returned DATETIME NOT NULL,
    PRIMARY KEY (reservation_id),
    FOREIGN KEY (reservation_id) REFERENCES reservation (reservation_id),
    FOREIGN KEY (equipment_id) REFERENCES equipment (equipment_id)
);
CREATE TABLE IF NOT EXISTS reservation_chemical (
    reservation_id INT NOT NULL,
    chemical_id INT NOT NULL,
    quantity INT NOT NULL,
    is_returned BOOLEAN DEFAULT false,
    date_returned DATETIME NOT NULL,
    PRIMARY KEY (reservation_id),
    FOREIGN KEY (reservation_id) REFERENCES reservation (reservation_id),
    FOREIGN KEY (chemical_id) REFERENCES chemical (chemical_id)
);
-- PREPARED RESERVATION
CREATE TABLE IF NOT EXISTS prepared_reservation (
    reservation_id INT NOT NULL,
    basket_id INT NOT NULL,
    admin_id INT NOT NULL,
    date_prepared DATETIME DEFAULT NOW(),
    PRIMARY KEY (reservation_id),
    FOREIGN KEY (reservation_id) REFERENCES reservation (reservation_id),
    FOREIGN KEY (basket_id) REFERENCES admin (admin_id),
    FOREIGN KEY (admin_id) REFERENCES admin (admin_id)
);
-- RELEASED RESERVATION
CREATE TABLE IF NOT EXISTS released_reservation (
    reservation_id INT NOT NULL,
    admin_id INT NOT NULL,
    released_date DATETIME NOT NULL,
    PRIMARY KEY (reservation_id),
    FOREIGN KEY (reservation_id) REFERENCES reservation (reservation_id),
    FOREIGN KEY (admin_id) REFERENCES admin (admin_id)
);