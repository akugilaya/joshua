<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            background-image: url('uploads/joshtip.png'); /* Add your logo as the background */
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: white;
        }
        .login-container {
            background-color: rgba(0, 0, 0, 0.5); /* semi-transparent background */
            padding: 30px;
            border-radius: 10px;
            width: 300px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #fff;
        }
        label {
            font-size: 16px;
            color: #fff;
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 2px solid #fff;
            border-radius: 5px;
            background-color: transparent;
            color: #fff;
            font-size: 14px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .password-container {
            position: relative;
        }
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: white;
        }
        #loginMessage {
            color: #f44336;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="" method="POST">
            <label for="username">Nama Pengguna</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Kata Sandi</label>
            <div class="password-container">
                <input type="password" id="password" name="password" required>
                <span class="toggle-password" onclick="togglePassword()">👁️</span>
            </div>
            <button type="submit" name="login">Login</button>
        </form>
        <p id="loginMessage">
            <?php
            if (isset($errorMessage)) {
                echo $errorMessage;
            }
            ?>
        </p>
    </div>

    <?php
    function logStatus($username, $statusCode, $message) {
        $logFile = 'login_log.txt';
        $timestamp = date("Y-m-d H:i:s");
        $formattedMessage = "[" . $timestamp . "] Status $statusCode: $message (User: $username)\n";
        file_put_contents($logFile, $formattedMessage, FILE_APPEND);
    }

    function saveLogToDatabase($username, $statusCode, $message) {
        include('config.php');
        $sql = "INSERT INTO login_logs (username, status_code, message) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sis", $username, $statusCode, $message);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }

    if (isset($_POST['login'])) {
        include('config.php');

        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM reg WHERE nama= ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $statusCode = 200; // Login sukses
                $message = "Login sukses";
                echo "<script>
                    document.getElementById('loginMessage').textContent = '$message';
                    console.log('$message untuk user: $username');
                </script>";
                logStatus($username, $statusCode, $message);
                saveLogToDatabase($username, $statusCode, $message);
                header("Location: afterlogin.html");
            } else {
                $statusCode = 401; // Password salah
                $message = "Password salah";
                echo "<script>
                    document.getElementById('loginMessage').textContent = '$message';
                    console.error('$message untuk user: $username');
                </script>";
                logStatus($username, $statusCode, $message);
                saveLogToDatabase($username, $statusCode, $message);
            }
        } else {
            $statusCode = 404; // Username tidak ditemukan
            $message = "Username tidak ditemukan";
            echo "<script>
                document.getElementById('loginMessage').textContent = '$message';
                console.warn('$message untuk user: $username');
            </script>";
            logStatus($username, $statusCode, $message);
            saveLogToDatabase($username, $statusCode, $message);
        }
        $stmt->close();
        $conn->close();
    }
    ?>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const passwordType = passwordField.type;
            passwordField.type = passwordType === 'password' ? 'text' : 'password';
        }
    </script>
</body>
</html>
