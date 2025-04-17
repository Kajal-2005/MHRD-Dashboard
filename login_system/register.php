<?php
// Show all errors for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include 'db.php'; // Make sure this connects correctly to your database

// Helper function to check if the request is AJAX
function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
           strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}

// Handle AJAX form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && is_ajax()) {
    header('Content-Type: application/json');

    $email = trim($_POST['email']);
    $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);

    // Check if email already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo json_encode(["status" => "error", "message" => "Email already registered!"]);
        exit;
    }

    $stmt->close();

    // Insert new user (email and password only)
    $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $password);

    if ($stmt->execute()) {
        $_SESSION['user_id'] = $stmt->insert_id;
        $_SESSION['email'] = $email;

        echo json_encode(["status" => "success", "redirect" => "login.php"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Database error: " . $stmt->error]);
    }

    $stmt->close();
    exit;
}
?>

<!-- HTML PART -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-cover bg-center min-h-screen flex items-center justify-center" style="background-image: url('loginBG.jpg');">
    <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-center mb-6">Register</h2>
        <form id="registerForm">
            <div class="mb-4">
                <label class="block text-gray-700">Email</label>
                <input type="email" name="email" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Enter your email" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Password</label>
                <input type="password" name="password" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600">Register</button>
        </form>

        <p class="mt-4 text-center text-gray-600">
            Already have an account? <a href="login.php" class="text-blue-500 font-semibold hover:underline">Login here</a>
        </p>
    </div>

    <script>
        document.getElementById("registerForm").addEventListener("submit", function(event) {
            event.preventDefault();

            let formData = new FormData(this);

            fetch("register.php", {
                method: "POST",
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest' // Ensures PHP recognizes it as AJAX
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data.status === "success") {
                    alert("Registration successful! Redirecting to login...");
                    window.location.href = data.redirect;
                } else {
                    alert(data.message || "Registration failed.");
                }
            })
            .catch(error => {
                console.error("Registration error:", error);
                alert("An error occurred during registration.");
            });
        });
    </script>
</body>
</html>

