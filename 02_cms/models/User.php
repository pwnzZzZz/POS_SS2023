<?php
 require_once('DatabaseObject.php');

 class User implements DatabaseObject {

    private $uid = 0;
    private $uname = '';
    private $upwhash = '';

    private $errors = [];

    public function __construct()
    {
        
    }

    public function validate() {
        return $this->validateHelper('Name', 'uname', $this->uname, 32) & 
        $this->validateHelper('UPWHash', 'upwhash', $this->upwhash, 64);
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
            
            if($this->uid != null && $this->uid > 0) {
                $this->update();
            } else {
                $this->uid = $this->create();
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

        $sql = 'INSERT INTO t_users (uname, upwhash) VALUES(?, ?)';
        $stmt = $db->prepare($sql);
        $stmt->execute(array($this->uname, $this->upwhash));
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

        $sql = 'UPDATE t_users SET uname = ?, upwhash = ? WHERE uid = ?';
        $stmt = $db->prepare($sql);
        $stmt->execute(array($this->uname, $this->upwhash, $this->uid));

        Database::disconnect();
    }

    /**
     * Get an object from database
     * @param integer $id
     * @return object single object or null
     */
    public static function get($id){
        $db = Database::connect();

        $sql = 'SELECT * FROM t_users WHERE uid = ?';
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        $item = $stmt->fetchObject('User');

        Database::disconnect();

        //Wenn ein Datensatz gefunden wurde, also dieser nicht false ist, wird
        //der entsprechende Datensatz zurückgegeben - ansonsten wird null 
        //zurückgegeben!
        return $item !== false ? $item : null;
    }

    public static function getByName($name){
        $db = Database::connect();

        $sql = 'SELECT * FROM t_users WHERE uname = ?';
        $stmt = $db->prepare($sql);
        $stmt->execute(array($name));
        $item = $stmt->fetchObject('User');

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

        $sql = 'SELECT * FROM t_users ORDER BY uname ASC';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_CLASS, 'User');

        Database::disconnect();

        return $items;
    }

    /**
     * Deletes the object from the database
     * @param integer $id
     */
    public static function delete($id){
        $db = Database::connect();

        $sql = 'DELETE FROM t_users WHERE uid = ?';
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));

        Database::disconnect();
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
     * Get the value of uname
     */ 
    public function getUname()
    {
        return $this->uname;
    }

    /**
     * Set the value of uname
     *
     * @return  self
     */ 
    public function setUname($uname)
    {
        $this->uname = $uname;

        return $this;
    }

    /**
     * Get the value of upwhash
     */ 
    public function getUpwhash()
    {
        return $this->upwhash;
    }

    /**
     * Set the value of upwhash
     *
     * @return  self
     */ 
    public function setUpwhash($upwhash)
    {
        $this->upwhash = $upwhash;

        return $this;
    }

    public static function getUserLogin($uname, $upwhash) : self {

        $userFromDb = self::getByName($uname);
        var_dump($userFromDb);

        if($userFromDb->getUpwhash() == $upwhash) {
            $userFromDb->login($userFromDb);
            return $userFromDb;
        } else {
            return null;
        }

    }

    public function login($user) {

        $_SESSION['login'] = true;
        $_SESSION['user'] = $user->getUid();
        return true;
    }

    public static function logout() {
        if(isset($_SESSION['login'])) {
            unset($_SESSION['login']);
            unset($_SESSION['user']);
        }
    }

    public static function isLoggedIn() {
        if(isset($_SESSION['login']) && $_SESSION["login"] == true) {
            return true;
        } else {
            return false;
        }
    }
 }

?>