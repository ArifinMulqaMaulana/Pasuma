<?php
session_start();

// Establish a connection to your MySQL database
$conn = new mysqli("localhost", "root", "", "pasuma");

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize the notification variable
$notification = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usernameOrEmail = $_POST["username"];
    $password = $_POST["password"];

    // Check if the input is a valid email
    if (filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL)) {
        $loginField = "email";
    } else {
        $loginField = "username";
    }

    // Fetch user from the database
    $sql = "SELECT * FROM users WHERE $loginField = '$usernameOrEmail'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $row["password"])) {
            // Password is correct, set session variables or redirect to the user's dashboard
            $_SESSION["user_id"] = $row["id"];
            $notification = "Login successful!";
        } else {
            $notification = "Invalid password";
        }
    } else {
        $notification = "User not found";
    }
    if (isset($_SESSION["user_id"])) {
        echo '<button id="logoutBtn">Logout</button>';
    }
}

// Close the database connection
$conn->close();
?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the notification from PHP
        var notification = "<?php echo $notification; ?>";

        // Display the notification if not empty
        if (notification.trim() !== "") {
            alert(notification);
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        var logoutBtn = document.getElementById('logoutBtn');
        if (logoutBtn) {
            logoutBtn.addEventListener('click', function() {
                // Redirect to the logout script when the button is clicked
                window.location.href = 'index.php';
            });
        }
    });
</script>
