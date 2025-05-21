<?php
session_start();
$conn = new mysqli("localhost", "u453976845_pbl", "adiPankhuri2964", "u453976845_pbl");
if ($conn->connect_error) die("Connection failed");

$username = $_POST['username'];
$password = $_POST['password'];
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    if (password_verify($password, $row['password'])) {
        $_SESSION["username"] = $username;
        header("Location: index.php");
        exit();
    }
}
echo "Invalid credentials";
?>