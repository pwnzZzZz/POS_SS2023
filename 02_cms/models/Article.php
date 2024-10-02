<?php
 require_once('DatabaseObject.php');

 class Article implements DatabaseObject {

    private $aid = 0;
    private $atitle = '';
    private $atext = '';
    private $acreationdate = '';
    private $uid = '';

    private $errors = [];

    public function __construct()
    {
        
    }

    public function validate() {
        return $this->validateHelper('Titel', 'atitle', $this->atitle, 32) & 
        $this->validateHelper('Text', 'atext', $this->atext, 255) &
        $this->validateHelper('Creationdate', 'acreationdate', $this->acreationdate, 64);
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
            
            if($this->aid != null && $this->aid > 0) {
                $this->update();
            } else {
                $this->aid = $this->create();
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

        $sql = 'INSERT INTO t_articles (atitle, atext, acreationdate, uid) VALUES(?, ?, ?, ?)';
        $stmt = $db->prepare($sql);
        $stmt->execute(array($this->atitle, $this->atext, $this->acreationdate, $this->uid));
        $lastId = $db->lastInsertId();

        Database::disconnect();

        return $lastId;
    }

    /**
     * Update an existing object in the database
     * @return boolean true on success
     */
    public function update(){
        $db = Database::connect();

        $sql = 'UPDATE t_articles SET atitle = ?, atext = ?, acreationdate = ?, uid = ? WHERE aid = ?';
        $stmt = $db->prepare($sql);
        $stmt->execute(array($this->atitle, $this->atext, $this->acreationdate, $this->uid, $this->aid));

        Database::disconnect();
    }

    /**
     * Get an object from database
     * @param integer $id
     * @return object single object or null
     */
    public static function get($id){
        $db = Database::connect();

        $sql = 'SELECT * FROM t_articles WHERE aid = ?';
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        $item = $stmt->fetchObject('Article');

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
    public static function getAll(){
        $db = Database::connect();

        $sql = 'SELECT * FROM t_articles ORDER BY atitle ASC';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_CLASS, 'Article');

        Database::disconnect();

        return $items;
    }

    /**
     * Deletes the object from the database
     * @param integer $id
     */
    public static function delete($id){
        $db = Database::connect();

        $sql = 'DELETE FROM t_articles WHERE aid = ?';
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));

        Database::disconnect();
    }



    /**
     * Get the value of aid
     */ 
    public function getAid()
    {
        return $this->aid;
    }

    /**
     * Set the value of aid
     *
     * @return  self
     */ 
    public function setAid($aid)
    {
        $this->aid = $aid;

        return $this;
    }

    /**
     * Get the value of atitle
     */ 
    public function getAtitle()
    {
        return $this->atitle;
    }

    /**
     * Set the value of atitle
     *
     * @return  self
     */ 
    public function setAtitle($atitle)
    {
        $this->atitle = $atitle;

        return $this;
    }

    /**
     * Get the value of atext
     */ 
    public function getAtext()
    {
        return $this->atext;
    }

    /**
     * Set the value of atext
     *
     * @return  self
     */ 
    public function setAtext($atext)
    {
        $this->atext = $atext;

        return $this;
    }

    

    /**
     * Get the value of uid
     */ 
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * Set the value of uid
     *
     * @return  self
     */ 
    public function setUid($uid)
    {
        $this->uid = $uid;

        return $this;
    }

    /**
     * Get the value of acreationdate
     */ 
    public function getAcreationdate()
    {
        return $this->acreationdate;
    }

    /**
     * Set the value of acreationdate
     *
     * @return  self
     */ 
    public function setAcreationdate($acreationdate)
    {
        $this->acreationdate = $acreationdate;

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

?>