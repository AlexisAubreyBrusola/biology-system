<?php

/*
    *PDO Database Class
    *Connect to Database
    *Create Prepared Statement
*/ 

class DbConn
{
    // database credentials
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbName = "biodb";

    // PDO Object
    private $dbh;
    private $stmt;
    private $error;


    public function __construct() {
        // SET UP THE DSN
        $dsn = 'mysql:host='. $this->host . ';dbname='. $this->dbName;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        try {
            // PDO CONNECTION
            $this->dbh = new PDO($dsn, $this->user, $this->password, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    // Prepare statement with query
    public function query($sql) {
        $this->stmt = $this->dbh->prepare($sql);
    }

    // Bind values to prepared statement using NAMED PARAMETERS
    public function bind($param, $value, $type = NULL) {
        if(is_null($type)) {
            switch(true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;   
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }
    // Execute the prepared statement
    public function execute() {
        return $this->stmt->execute();
    }
    // Return multiple records / Get multiple rows of data
    public function resultSet() {
        $this->execute();
        return $this->stmt->fetchALL(PDO::FETCH_ASSOC);
    }

    // Return a single result / Get single row of data
    public function single() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get row count
    public function rowCount() {
        return $this->stmt->rowCount();
    }
}