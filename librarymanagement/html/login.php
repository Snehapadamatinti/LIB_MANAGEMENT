<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>HTML5 Login Form with validation Example</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="design.css">

</head>

<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve the submitted username and password
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Establish a database connection
        $conn = new mysqli("localhost", "root", "", "signup");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute the SQL query to retrieve user information
        $sql = "SELECT * FROM library_management WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // User found in the database
            $row = $result->fetch_assoc();
            $storedPassword = $row["Password"];
            if ($password === $storedPassword) {
                // Successful login
                // Redirect to the desired page
                echo "<script>alert('You have successfully logged in !');</script>";
                header("Location: abc.html");
                exit();
            } else {
                // Invalid password
                echo "Invalid password!";
            }
        } else {
            // User not found
            echo "User not found!";
        }

        // Close the database connection
        $conn->close();
    }
    ?>

    <div id="login-form-wrap">
        <h2>LOGIN</h2>
        <form id="login-form" method="POST">
            <p>
                <input type="text" id="username" name="username" placeholder="Username" required><i
                    class="validation"><span></span><span></span></i>
            </p>
            <p>
                <input type="password" id="password" name="password" placeholder="Password" required><i
                    class="validation"><span></span><span></span></i>
            </p>
            <p>
                <input type="submit" value="Login" />
            </p>
        </form>
        <div id="create-account-wrap">
            <p>Not a member? <a href="signup.html">Create Account</a></p>
        </div>
    </div>

</body>

</html>
