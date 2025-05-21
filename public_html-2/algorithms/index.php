<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>FCFS Scheduler Terminal</title>
    <link rel="stylesheet" href="style.css">
    <style>
        #terminal { width: 100%; height: 400px; overflow-y: auto; background: #000; padding: 10px; border: 1px solid #333; color: #0f0; font-family: monospace; }
        input[type="text"] { width: 100%; padding: 10px; background: #000; color: #0f0; border: 1px solid #333; font-family: monospace; }
    </style>
</head>
<body>
<div class="container">
    <div class="logout">
        Logged in as <strong><?php echo htmlspecialchars($_SESSION["username"]); ?></strong> |
        <a href="logout.php">Logout</a>
    </div>
    <h2>FCFS Scheduler Terminal</h2>
    <div id="terminal"><div id="output"></div></div>
    <form id="terminalForm">
        <input type="text" id="commandInput" placeholder="Enter command..." autofocus autocomplete="off" />
    </form>
</div>
<script src="script.js"></script>
</body>
</html>