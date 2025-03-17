<?php

declare(strict_types=1);
error_reporting(E_ALL);

require("classes/user.php");

class db
{

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
    public function __construct()
    {
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
    public function get_users(): array
    {
        $result = null;
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM `user` ORDER BY `id` DESC");
            $stmt->execute();
            $result = $stmt->fetchAll();

            foreach ($result as $row) {
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

    public function hello_world()
    {
        return "Hello world";
    }

    public function message($message)
    {
        return $message;
    }

    public function get_html_user_table()
    {
        $result = $this->get_users();   // array met users
        $html_table = "<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
        </tr>
    </thead>";
        // $result is an array with users
        foreach ($result as $user) {
           
            $html_table .= "<tr>";
            $html_table .= "<td>" . $user->id . "</td>";
            $html_table .= "<td>" . $user->name . "</td>";
            $html_table .= "<td>" . $user->age . "</td>";
            $html_table .= "</tr>";
        }
        $html_table .= "</table>";
        return $html_table;
    }
}
