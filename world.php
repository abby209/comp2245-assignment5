<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $input = isset($_GET['name']) ? $_GET['name'] : '';

    $sql = "SELECT * FROM countries WHERE name LIKE :name";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':name', '%' . $input . '%', PDO::PARAM_STR);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Output an HTML table
    if (count($results) > 0) {
        echo '<table border="1">';
        echo '<tr>';
        echo '<th>Country Name</th>';
        echo '<th>Continent</th>';
        echo '<th>Independence Year</th>';
        echo '<th>Head of State</th>';
        echo '</tr>';

        foreach ($results as $row) {
            echo '<tr>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['continent'] . '</td>';
            echo '<td>' . $row['independence_year'] . '</td>';
            echo '<td>' . $row['head_of_state'] . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo 'No results found.';
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
