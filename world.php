<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get the 'country' parameter from the URL
    $country = isset($_GET['country']) ? $_GET['country'] : '';

    // Modify the SQL query to fetch information for the specified country or partial match
    $sql = "SELECT * FROM countries WHERE name LIKE :country";
    $stmt = $conn->prepare($sql);
    
    // Allow partial matches by adding '%' to the beginning and end of the country name
    $stmt->bindValue(':country', '%' . $country . '%', PDO::PARAM_STR);

    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($results);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
