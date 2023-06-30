

<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["Password"];
    $confirmPassword = $_POST["confirmPassword"];

    // Validate and process the form data as needed
    if ($password !== $confirmPassword) {
        echo "<script>alert('Password and Confirm Password do not match!');</script>";
    } else {
        // Establish a database connection
        $conn = new mysqli("localhost", "root", "", "signup");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute the SQL query to insert the data into the database
        $sql = "INSERT INTO library_management (username, `Email Address`, `Password`, `Confirm Password`) VALUES ('$username', '$email', '$password', '$confirmPassword')";
        if ($conn->query($sql) === true) {
            // Data inserted successfully
            
            echo "<script>alert('You have successfully registered!');</script>";
            // Redirect to the login page
            header("Location: login.php");
            exit();
        } else {
            // Error inserting data
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the database connection
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>HTML5 Login Form with validation Example</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="design.css">

    <script>
        function validateForm() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirmPassword").value;

            if (password !== confirmPassword) {
                alert("Password and Confirm Password do not match!");
                return false;
            }
        }
    </script>
</head>

<body>
    <div id="login-form-wrap">
        <h2>SIGNUP</h2>
        <form id="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"
            onsubmit="return validateForm();">
            <p>
                <input type="text" id="username" name="username" placeholder="Username" required><i
                    class="validation"><span></span><span></span></i>
            </p>
            <p>
                <input type="email" id="email" name="email" placeholder="Email Address" required><i
                    class="validation"><span></span><span></span></i>
            </p>
            <p>
                <input type="password" id="password" name="Password" placeholder="Password" required><i
                    class="validation"><span></span><span></span></i>
            </p>
            <p>
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password"
                    required><i class="validation"><span></span><span></span></i>
            </p>
            <p>
                <input type="submit" id="submit" value="Submit">
            </p>
        </form>
        <div id="create-account-wrap">
            <p>Already a member? <a href="login.html">Login</a></p>
        </div>
    </div>
</body>

</html>

