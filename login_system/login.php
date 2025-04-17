<?php
session_start();
include 'db.php'; // Connect to your DB

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    header('Content-Type: application/json');

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['user_email'] = $email; 
            echo json_encode(["status" => "success", "redirect" => "../MHRD/dashboard.php"]);
            exit();
        }
    }

    echo json_encode(["status" => "error", "message" => "Invalid email or password."]);
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-cover bg-center min-h-screen flex items-center justify-center" style="background-image: url('loginBG.jpg');">
    <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-center mb-6">Login</h2>
        <form id="loginForm">
            <div class="mb-4">
                <label class="block text-gray-700">Email</label>
                <input type="email" name="email" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Enter your email" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Password</label>
                <input type="password" name="password" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">Login</button>
        </form>

        <!-- Register Link -->
        <p class="mt-4 text-center text-gray-600">
            Don't have an account? <a href="register.php" class="text-green-500 font-semibold hover:underline">Register here</a>
        </p>
    </div>

    <script>
        document.getElementById("loginForm").addEventListener("submit", function(event) {
            event.preventDefault();

            let formData = new FormData(this);

            fetch("login.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    window.location.href = data.redirect;
                } else {
                    alert(data.message || "Login failed.");
                }
            })
            .catch(error => {
                console.error("Login error:", error);
                alert("An error occurred while logging in.");
            });
        });
    </script>
</body>
</html>
