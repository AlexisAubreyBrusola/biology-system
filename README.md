###### *This documentation is for the next developers that will continue developing the system.*

*Note: This codebase was created by inexperience developers. You can continue developing the system using this codebase, or you can use it as a reference. All of the materials provided below can be use as a reference and not as a final output.*

###### Modules created:
    1. Admin login
    2. Admin dashboard
    3. Add admin account
    4. Add borrower
    5. Add equipment
    6. Add chemical
# DOCUMENTATION
###### *BUCS Natural Science Laboratory & Instrumentation Office Borrowing System*

## 1. System's Architecture Pattern
###### MVC (Model-View-Controller) Architecture Design Pattern
MVC Framework: https://www.tutorialspoint.com/mvc_framework/mvc_framework_introduction.htm
*Please research more about MVC Architecture Pattern.*
###### PDO (PHP Data Objects): For the database connection
[What is PDO?](https://www.javatpoint.com/php-pdo)
[PHP Data Object: php official documentation](https://www.php.net/manual/en/book.pdo.php)

## 2. Database Design
Here's the link for the database design:
[Bio's ERD: Lucidchart](https://tinyurl.com/52kbyh3e)

## 3. Inital UI Design
Here's the link of the UI design:
[BIO System's UI: Figma](https://tinyurl.com/ycky7vcm)

# ABOUT THE CODES
## 1. Naming of files
The inital developers use this kind of naming convention for the files for easy identification of what the file is for. For example, *add-admin.controller.php*, the '.controller.php' part of the file name is to easily identify the file contains the controller for adding admin accounts.

## 2. The dbConn.config.php file
This file contains the code for the connection to the database. If you don't understand the code. You can refer to this Youtube video [Build A Login System in PHP With MVC & PDO](https://www.youtube.com/watch?v=lSVGLzGBEe0&t=1015s).

## 3. 'view' folder
This folder contains all the php files that's responsible for the frontend part of the system.

## 4. 'models' folder
This folder contains all the php files that holds the classes and methods that handles the data storage, retrieval, manipulation, and validation.

## 5. 'controllers' folder
This folder contains all the php files that holds the classes and methods that is responsible for processing user requests, coordinating the interaction between the Model and the View, and updating the View with any changes in the data.

## 6. 'uploads' folder
This folder contains all the uploaded images when adding chemicals and equipments.

## 7. 'assets' folder
This folder contains the CSS files, Bootstrap v5.3 bundles (including the CSS and JavaScript), the Fontawesome icons bundles, and the images folder where all the images used in the UI of the system.

## 8. 'reference_no_generator.php' file
It is where the initial developers test some codes.

## 9. 'dropdown-option.model.php' and 'dropdown-option.controller.php'
This php files contains the code that handles the rendering of options on dropdowns or select elements.

## 10. 'include' folder
This folder contains all the include files such as the header file, footer file, sidebar file, etc. This files is responsible for rendering parts of the system. All of the files inside the include folder is used frequently on different part of the system. It removes the repeating of codes.


*For more information and questions, contact me at alexisaubreybonon.brusola@bicol-u.edu.ph*