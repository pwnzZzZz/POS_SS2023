<?php

require_once('DatabaseObject.php');

class Zimmer implements DatabaseObject{

    private $id;
    private $nr;
    private $name;
    private $personen;
    private $preis;
    private $balkon;

    public function __construct(){
        
    }


        /**
     * Creates a new object in the database
     * @return integer ID of the newly created object (lastInsertId)
     */
    public function create(){
        $db = Database::connect();

        $sql = "INSERT INTO zimmer(nr, name, personen, preis, balkon) VALUES (? ,? ,? ,? ,? )";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($this->nr, $this->name, $this->personen, $this->preis, $this->balkon));

        $room = $stmt->fetchObject('Zimmer');
        Database::disconnect();
        return $room;
    }

    /**
     * Update an existing object in the database
     * @return boolean true on success
     */
    public function update(){
        $db = Database::connect();

        $sql = "UPDATE zimmer SET nr = ?, name = ?, personen = ?, preis = ?, balkon = ? WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($this->nr, $this->name, $this->personen, $this->preis, $this->balkon, $this->id));

        $roomUpdated = $stmt->fetchObject('Zimmer');
        Database::disconnect();
        return $roomUpdated;
    }

    /**
     * Get an object from database
     * @param integer $id
     * @return object single object or null
     */
    public static function get($id){
        $db = Database::connect();

        $sql = "SELECT * FROM zimmer WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));


        $room = $stmt->fetchObject('Zimmer');

        Database::disconnect();
        return $room;
    }

    /**
     * Get an array of objects from database
     * @return array array of objects or empty array
     */
    public static function getAll(){
        $db = Database::connect();

        $sql = "SELECT * FROM zimmer";
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $array = $stmt->fetchAll(PDO::FETCH_CLASS, 'Zimmer');

        Database::disconnect();
        return $array;
    }

    /**
     * Deletes the object from the database
     * @param integer $id
     */
    public static function delete($id){
        $db = Database::connect();

        $sql = "DELETE FROM zimmer WHERE id = ?";
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
     * Get the value of nr
     */ 
    public function getNr()
    {
        return $this->nr;
    }

    /**
     * Set the value of nr
     *
     * @return  self
     */ 
    public function setNr($nr)
    {
        $this->nr = $nr;

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
     * Get the value of personen
     */ 
    public function getPersonen()
    {
        return $this->personen;
    }

    /**
     * Set the value of personen
     *
     * @return  self
     */ 
    public function setPersonen($personen)
    {
        $this->personen = $personen;

        return $this;
    }

    /**
     * Get the value of preis
     */ 
    public function getPreis()
    {
        return $this->preis;
    }

    /**
     * Set the value of preis
     *
     * @return  self
     */ 
    public function setPreis($preis)
    {
        $this->preis = $preis;

        return $this;
    }

    /**
     * Get the value of balkon
     */ 
    public function getBalkon()
    {
        return $this->balkon;
    }

    /**
     * Set the value of balkon
     *
     * @return  self
     */ 
    public function setBalkon($balkon)
    {
        $this->balkon = $balkon;

        return $this;
    }
}


?>