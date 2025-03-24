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

    public function updateUser($id, $name, $age) : bool {
        $result = false;
        try {
            $stmt = $this->pdo->prepare("UPDATE `user` SET `name` = ?, `age` = ? WHERE `id` = ?");
            $stmt->bindParam(1, $name);
            $stmt->bindParam(2, $age);
            $stmt->bindParam(3, $id);
            $result = $stmt->execute();
        } catch (PDOException $e) {
            $result = false;
        }
        return $result;
    }


   

    public function getUser($id) : user {
        $result = null;
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM `user` WHERE `id` = ?");
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $row = $stmt->fetch(); //assoc array
            $user = new user();
            $user->id = $row['id'];
            $user->name = $row['name'];
            $user->age = $row['age'];
            $result = $user;
        } catch (PDOException $e) {
            $result = null;
        }
        return $result;
    }

    public function doLogin($username, $password, &$usr, &$error): bool
    {
        $result = false;
        
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM `user` WHERE `name` = ?");
            $stmt->bindParam(1, $username);
            $stmt->execute();
            $user = $stmt->fetch();
            

            if ($user) {
                $hash = $user['password'];
                if (password_verify($password, $hash)) {
                    $result = true;
                     $usr = $user;
                }
            }
        } catch (PDOException $e) {
            $error = $e;
            $result = false;
        }
       return $result;
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

    public function register_user($name,$age,$password) : bool{
        $result = false;
        try {
            $stmt = $this->pdo->prepare("INSERT INTO `user` (`name`, `age`,`password`) VALUES (?, ?,?)");
            $stmt->bindParam(1, $name);
            $stmt->bindParam(2, $age);
            $password = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bindParam(3, $password);
            $result = $stmt->execute(); // true / false;
        } catch (PDOException $e) {
            //var_dump($e);
            $result = false;
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


public function get_html_user_edit_form($user) : string {
    
    $html = <<< HTML
    <h1>Edit user</h1>
    <form method="post">
        <input type="text" name="name" value="$user->name">
        <input type="text" name="age" value="$user->age">
        <input type="submit" name="submit" value="Update">
        <input type="hidden" name="id" value="$user->id">
    </form>
HTML;
    
    
return $html;

}

public function get_html_user_delete_form($user) : string {
    $html = <<< HTML
    <h1>Delete user "$user->name"</h1>
    <form method="post">
        <input type="submit" name="submit" value="Delete">
        <input type="hidden" name="id" value="$user->id">
    </form>
HTML;
return $html;
}

    public function get_html_user_table()
    {
        $result = $this->get_users();   // array met users
        $html_table = "<table>
    <thead>
        <tr>
            <th>CRUD</th>
            <th>Name</th>
            <th>Age</th>
        </tr>
    </thead>";
        // $result is an array with users
        foreach ($result as $user) {
           
            $html_table .= "<tr>";

            if($_SESSION["user"]["id"] == $user->id) {
                $html_table .= "<td><a href=\"?action=update&id=$user->id\"><i class=\"fa-solid fa-pen\"></i></a><a href=\"?action=delete&id=$user->id\"><i class=\"fa-solid fa-trash\"></i></a></td>";
                
            } else {
                $html_table .= "<td>$user->id</td>";
            }

            //$html_table .= "<td><a href='?id=$user->id'>$user->id</a></td>";
            $html_table .= "<td>" . htmlspecialchars($user->name). "</td>";
            $html_table .= "<td>" . $user->age . "</td>";
            $html_table .= "</tr>";
        }
        $html_table .= "</table>";
        return $html_table;
    }
}
