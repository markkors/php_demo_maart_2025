<?php
declare(strict_types=1);
error_reporting(E_ALL);

require("classes/user.php");

class db {
 
    private $pdo;
    private $host = "localhost";
    private $dbname = "gastenboek";
    private $dbuser = "gastenboek";
    private $dbpass = "gastenboek";

    // property to store all users
    public $users = [];

    /**
     * Constructor, initialize database connection
     */
    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->dbuser, $this->dbpass);
        } catch (PDOException $e) {
            echo "Database connection failed: " . $e->getMessage();
        }
    }

    /***
     * Get all users from the database
     * @return array
     */
    public function get_users() : array {
        $result = null;
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM `user` ORDER BY `id` DESC");
            $stmt->execute();
            $result = $stmt->fetchAll();

            foreach($result as $row) {
                // maak een nieuwe user aan
                $user = new user();
                $user->id = $row['id'];
                $user->name = $row['name'];
                $user->age = $row['age'];
                // add user to array
                array_push($this->users, $user);
            }
            $result = $this->users;
        } catch (PDOException $e) {
            // return empty array on error
            $result = [];        
        }
        return $result;
    }
}

?>