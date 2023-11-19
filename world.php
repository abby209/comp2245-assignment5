<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $input = isset($_GET['name']) ? $_GET['name'] : '';
    $type = isset($_GET['type']) ? $_GET['type'] : '';

    if ($type === 'countries') {
        $sql = "SELECT * FROM countries WHERE name LIKE :name";
    } elseif ($type === 'cities') {
        $sql = "SELECT * FROM cities WHERE name LIKE :name";
    } else {
        echo 'Invalid lookup type';
        exit;
    }
    

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':name', '%' . $input . '%', PDO::PARAM_STR);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    

    if (count($results) > 0) {
        // Output an HTML table
        echo '<table border="1">';
        // Output table headers based on the type
        if ($type === 'countries') {
            echo '<tr>';
            echo '<th>Country Name</th>';
            echo '<th>Continent</th>';
            echo '<th>Independence Year</th>';
            echo '<th>Head of State</th>';
            echo '</tr>';
        } elseif ($type === 'cities') {
            echo '<tr>';
            echo '<th>City Name</th>';
            echo '<th>Population</th>';
            echo '<th>District</th>';
            echo '</tr>';
        }

        foreach ($results as $row) {
            echo '<tr>';
            // Output table data based on the type
            if ($type === 'countries') {
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['continent'] . '</td>';
                echo '<td>' . $row['independence_year'] . '</td>';
                echo '<td>' . $row['head_of_state'] . '</td>';
            } elseif ($type === 'cities') {
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['population'] . '</td>';
                echo '<td>' . $row['district'] . '</td>';
            }
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
