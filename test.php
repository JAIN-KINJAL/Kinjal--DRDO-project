<?php
// Database connection
$mysqli = new mysqli("localhost", "root", "", "proforma_db");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// SQL query for the 'records' table
$sql = "SELECT * FROM records";
$result = $mysqli->query($sql);

// Check if query executed successfully
if (!$result) {
    die("Query failed: " . $mysqli->error);
}

// Display rows
if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr><th>ID</th><th>Username</th><th>Location</th><th>Size</th><th>Created</th><th>Group ID</th></tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['location'] . "</td>";
        echo "<td>" . $row['size'] . "</td>";
        echo "<td>" . $row['id_created'] . "</td>";
        echo "<td>" . $row['group_id'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No records found.";
}

// Close connection
$mysqli->close();
?>
