<?php
$servername = "localhost";
$username = "may1631";
$password = "ljstd7pi";
$dbname = "may1631_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM user";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["first_name"]. " " . $row["last_name"]. "<br>";
    }
} else {
    echo "0 results";

}


    if (isset($_POST['name']) && isset($_POST['info']))
    {
        echo "<strong>Post received.</strong> <br/> <br/> <strong>Name:</strong> " . $_POST['name'] . "<br/><strong>Info:</strong> " . $_POST['info'];
    }
    else
    {
        echo "Post not received.";
    }

$conn->close();
?>