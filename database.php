<?php

class Data {
    private $conn;

    public function __construct($host, $username, $password, $database) {
        try {
            $this->conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function push($name, $email, $status, $gender, $browser, $ip_address) {
        try {
            $sql = "INSERT INTO users (name, email, status, gender, browser, ip_address) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(1, $name, PDO::PARAM_STR);
            $stmt->bindParam(2, $email, PDO::PARAM_STR);
            $stmt->bindParam(3, $status, PDO::PARAM_STR);
            $stmt->bindParam(4, $gender, PDO::PARAM_STR);
            $stmt->bindParam(5, $browser, PDO::PARAM_STR);
            $stmt->bindParam(6, $ip_address, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function updateByEmail($email, $newName, $newStatus, $newGender) {
        try {
            $sql = "UPDATE users SET name = :newName, status = :newStatus, gender = :newGender WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
        
            $stmt->bindParam(':newName', $newName, PDO::PARAM_STR);
            $stmt->bindParam(':newStatus', $newStatus, PDO::PARAM_STR);
            $stmt->bindParam(':newGender', $newGender, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        
            return $stmt->execute();
        } catch (PDOException $e) {
            die("Error updating data: " . $e->getMessage());
        }
    }
    

    public function getEmail($email) {
        try {
            $sql = "SELECT * FROM users WHERE email = ?";
            $stmt = $this->conn->prepare($sql);
    
            $stmt->bindParam(1, $email, PDO::PARAM_STR);
    
            $stmt->execute();
    
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $result;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
    
    public function show(){
        $sql = "SELECT name, email, status, gender FROM users";
        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }


    public function closeConnection() {
        $this->conn = null;
    }
}

?>
