<?php
session_start();
if (!isset($_SESSION["username"])) exit("Not logged in");

$conn = new mysqli("localhost", "u453976845_pbl", "adiPankhuri2964", "u453976845_pbl");
if ($conn->connect_error) die("Connection failed");

$cmd = trim($_POST['command']);
$user = $_SESSION["username"];
$conn->query("INSERT INTO history (username, command) VALUES ('$user', '$cmd')");

if (preg_match('/^FCFS/i', $cmd)) {
    require 'algorithms/fcfs.php';
    header('Content-Type: application/json');
    echo fcfs_handler($cmd);
    exit;
}

header('Content-Type: text/plain');
switch (strtolower($cmd)) {
    case "date": echo "📅 " . date("l, F j, Y"); break;
    case "time": echo "⏰ " . date("h:i:s A"); break;
    case "help":
        echo "Available commands:\nFCFS P1 0 5 P2 1 3\ndate\ntime\nclear\nhelp"; break;
    default: echo "❌ Unknown command. Try 'help'.";
}
?>