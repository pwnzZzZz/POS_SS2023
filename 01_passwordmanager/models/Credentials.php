<?php

require_once("DatabaseObject.php");

class Credentials implements DatabaseObject {

    private $id = 0;
    private $name = '';
    private $domain = '';
    private $cms_username = '';
    private $cms_password = '';

    private $errors = [];

    public function __construct() {

    }

    public function validate() {
        return $this->validateHelper('Name', 'name', $this->name, 32) & 
        $this->validateHelper('Domäne', 'domain', $this->domain, 128) &
        $this->validateHelper('CMS_Username', 'cms_username', $this->cms_username, 64) &
        $this->validateHelper('CMS_Password', 'cms_password', $this->cms_password, 64);
    }

    private function validateHelper($label, $key, $value, $maxLenght) {
        if(strlen($value) == 0) {
            $this->errors[$key] = "$label darf nicht leer sein!";
            return false;
        } else if(strlen($value) == $maxLenght) {
            $this->errors[$key] = "$label zu lang (max. $maxLenght Zeichen)";
            return false;
        } else {
            return true;
        }
    }

    public function save() {
        if($this->validate()) {
            
            if($this->id != null && $this->id > 0) {
                $this->update();
            } else {
                $this->id = $this->create();
            }

            return true;
        }

        return false;
    }

    /**
     * Creates a new object in the database
     * @return integer ID of the newly created object (lastInsertId)
     */
    public function create() {
        $db = Database::connect();

        $sql = 'INSERT INTO credentials (name, domain, cms_username, cms_password) VALUES(?, ?, ?, ?)';
        $stmt = $db->prepare($sql);
        $stmt->execute(array($this->name, $this->domain, $this->cms_username, $this->cms_password));
        $lastId = $db->lastInsertId();

        Database::disconnect();

        return $lastId;
    }

    /**
     * Update an existing object in the database
     * @return boolean true on success
     */
    public function update() {
        $db = Database::connect();

        $sql = 'UPDATE credentials SET name = ?, domain = ?, cms_username = ?, cms_password = ? WHERE id = ?';
        $stmt = $db->prepare($sql);
        $stmt->execute(array($this->name, $this->domain, $this->cms_username, $this->cms_password, $this->id));

        Database::disconnect();
    }

    /**
     * Get an object from database
     * @param integer $id
     * @return object single object or null
     */
    public static function get($id) {
        $db = Database::connect();

        $sql = 'SELECT * FROM credentials WHERE id = ?';
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        $item = $stmt->fetchObject('Credentials');

        Database::disconnect();

        //Wenn ein Datensatz gefunden wurde, also dieser nicht false ist, wird
        //der entsprechende Datensatz zurückgegeben - ansonsten wird null 
        //zurückgegeben!
        return $item !== false ? $item : null;
    }

    /**
     * Get an array of objects from database
     * @return array array of objects or empty array
     */
    public static function getAll() {
        $db = Database::connect();

        $sql = 'SELECT * FROM credentials ORDER BY name ASC, domain ASC';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_CLASS, 'Credentials');

        Database::disconnect();

        return $items;
    }

    /**
     * Deletes the object from the database
     * @param integer $id
     */
    public static function delete($id) {
        $db = Database::connect();

        $sql = 'DELETE FROM credentials WHERE id = ?';
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
     * Get the value of domain
     */ 
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Set the value of domain
     *
     * @return  self
     */ 
    public function setDomain($domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Get the value of cms_username
     */ 
    public function getCms_username()
    {
        return $this->cms_username;
    }

    /**
     * Set the value of cms_username
     *
     * @return  self
     */ 
    public function setCms_username($cms_username)
    {
        $this->cms_username = $cms_username;

        return $this;
    }

    /**
     * Get the value of cms_password
     */ 
    public function getCms_password()
    {
        return $this->cms_password;
    }

    /**
     * Set the value of cms_password
     *
     * @return  self
     */ 
    public function setCms_password($cms_password)
    {
        $this->cms_password = $cms_password;

        return $this;
    }

    /**
     * Get the value of errors
     */ 
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Set the value of errors
     *
     * @return  self
     */ 
    public function setErrors($errors)
    {
        $this->errors = $errors;

        return $this;
    }

}