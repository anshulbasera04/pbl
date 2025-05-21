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
    <title>Web Based Terminal</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            margin: 10px;
            padding:0;
            background-color: #1e1e2f;
            color: #f0f0f0;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #2c2c3e;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
        }

        .logout {
            text-align: right;
            margin-bottom: 10px;
        }

        h2 {
            text-align: center;
            color: #ffffff;
        }

        #terminal {
            width: 100%;
            height: 400px;
            overflow-y: auto;
            background: #000;
            padding: 10px;
            border: 1px solid #333;
            color: #0f0;
            font-family: monospace;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            background: #000;
            color: #0f0;
            border: 1px solid #333;
            font-family: monospace;
            border-radius: 4px;
        }

        a {
            color: #00ffff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="logout">
        Logged in as <strong><?php echo htmlspecialchars($_SESSION["username"]); ?></strong> |
        <a href="logout.php">Logout</a>
    </div>
    <h2>Web Based Terminal</h2>
    <div id="terminal"><div id="output"></div></div>
    <form id="terminalForm">
        <input type="text" id="commandInput" placeholder="Enter command..." autofocus autocomplete="off" />
    </form>
</div>
<script src="script.js"></script>
</body>
</html>
