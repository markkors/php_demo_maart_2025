<?php

function connect_db() {
    $pdo = new PDO("mysql:host=localhost;dbname=gastenboek", "gastenboek", "gastenboek");
    return $pdo;
}


function insert_user() : bool{
    if(isset($_POST['user']) && isset($_POST['age'])){
        $pdo = connect_db();
        $stmt = $pdo->prepare("INSERT INTO `user` (`name`, `age`) VALUES (?, ?)");
        $stmt->bindParam(1, $_POST['user']);
        $stmt->bindParam(2, $_POST['age']);
        return $stmt->execute();
    }
    return false;
}

function get_users() : array {
    $pdo = connect_db();
    $stmt = $pdo->prepare("SELECT * FROM `user` ORDER BY `id` DESC");
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}

function get_html_user_table() : string {
    $result = get_users();
    $html_table = "<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
        </tr>
    </thead>";

    foreach($result as $row){
        $html_table .= "<tr>";
        $html_table .= "<td>" . $row['id'] . "</td>";
        $html_table .= "<td>" . $row['name'] . "</td>";
        $html_table .= "<td>" . $row['age'] . "</td>";
        $html_table .= "</tr>";
    }
    $html_table .= "</table>";
    return $html_table;
}

?>
