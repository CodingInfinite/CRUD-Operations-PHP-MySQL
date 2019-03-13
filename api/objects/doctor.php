<?php
class Doctor{
 
    // database connection and table name
    private $conn;
    private $table_name = "doctors";
 
    // object properties
    public $id;
    public $name;
    public $email;
    public $password;
    public $phone;
    public $gender;
    public $address;
    public $cnic;
    public $profile_status;
    public $specialist;
    public $created;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read all doctors
    function read(){
    
        // select all query
        $query = "SELECT
                    `id`, `name`, `email`, `password`, `phone`, `gender`, `address`, `cnic`, `profile_status`, `specialist`, `created`
                FROM
                    " . $this->table_name . " 
                ORDER BY
                    id DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // get single doctor data
    function read_single(){
    
        // select all query
        $query = "SELECT
                    `id`, `name`, `email`, `password`, `phone`, `gender`, `address`, `cnic`, `profile_status`, `specialist`, `created`
                FROM
                    " . $this->table_name . " 
                WHERE
                    id= '".$this->id."'";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        return $stmt;
    }

    // create doctor
    function create(){
    
        if($this->isAlreadyExist()){
            return false;
        }
        
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    name=:name, email=:email, password=:password, phone=:phone, gender=:gender, cnic=:cnic, address=:address, profile_status=:profile_status, specialist=:specialist, created=:created";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->phone=htmlspecialchars(strip_tags($this->phone));
        $this->gender=htmlspecialchars(strip_tags($this->gender));
        $this->cnic=htmlspecialchars(strip_tags($this->cnic));
        $this->address=htmlspecialchars(strip_tags($this->address));
        $this->profile_status=htmlspecialchars(strip_tags($this->profile_status));
        $this->specialist=htmlspecialchars(strip_tags($this->specialist));
        $this->created=htmlspecialchars(strip_tags($this->created));
    
        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":gender", $this->gender);
        $stmt->bindParam(":cnic", $this->cnic);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":profile_status", $this->profile_status);
        $stmt->bindParam(":specialist", $this->specialist);
        $stmt->bindParam(":created", $this->created);
    
        // execute query
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }
    
        return false;
        
    }

    // update doctor 
    function update(){
    
        // query to insert record
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    name='".$this->name."', email='".$this->email."', password='".$this->password."', phone='".$this->phone."', cnic='".$this->cnic."', address='".$this->address."'
                WHERE
                    id='".$this->id."'";
    
        // prepare query
        $stmt = $this->conn->prepare($query);

        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // delete doctor
    function delete(){
        
        // query to insert record
        $query = "DELETE FROM
                    " . $this->table_name . "
                WHERE
                    id= '".$this->id."'";
        
        // prepare query
        $stmt = $this->conn->prepare($query);

        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function isAlreadyExist(){

        $query = "SELECT *
            FROM
                " . $this->table_name . " 
            WHERE
                email='".$this->email."'";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }
}