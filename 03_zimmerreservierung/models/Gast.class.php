<?php

require_once('DataBaseObject.php');

class Gast implements DatabaseObject{

    private $id;
    private $name;
    private $email;
    private $adresse;




     /**
     * Creates a new object in the database
     * @return integer ID of the newly created object (lastInsertId)
     */
    public function create(){
        $db = Database::connect();

        $sql = "INSERT INTO gast(name, email, adresse) VALUES (?, ?, ?)";
        $stmt = $db->prepare($sql);
        $guest = $stmt->execute(array($this->name, $this->email, $this->adresse));

        Database::disconnect();
    }

    /**
     * Update an existing object in the database
     * @return boolean true on success
     */
    public function update(){
        $db = Database::connect();

        $sql = "UPDATE gast SET id = ?,name = ?, email = ?,adresse= ? WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($this->id, $this->name, $this->email, $this->adresse, $this->id));

        Database::disconnect();

    }

    /**
     * Get an object from database
     * @param integer $id
     * @return object single object or null
     */
    public static function get($id){
        $db = Database::connect();

        $sql = "SELECT * FROM gast WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));

        $guest = $stmt->fetchObject("Gast");
        Database::disconnect();
        return $guest !== FALSE ? $guest : NULL;

    }

    /**
     * Get an array of objects from database
     * @return array array of objects or empty array
     */
    public static function getAll(){
        $db = Database::connect();
        
        $sql = "SELECT * FROM gast";
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $array = $stmt->fetchAll(PDO::FETCH_CLASS, "Gast");
        Database::disconnect();

        return $array;
    }

    /**
     * Deletes the object from the database
     * @param integer $id
     */
    public static function delete($id){
        $db = Database::connect();

        $sql = "DELETE FROM gast WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));

        Database::disconnect();
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of adresse
     */ 
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set the value of adresse
     *
     * @return  self
     */ 
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }
}



?>