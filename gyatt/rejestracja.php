<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "messenger_clone");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Enable error reporting for debugging (development only)
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Handle file upload
    $targetDir = "uploads/";
    $fileName = basename($_FILES["profile_picture"]["name"]);
    $targetFile = $targetDir . uniqid() . "_" . $fileName;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Validate uploaded file
    if ($_FILES["profile_picture"]["error"] === UPLOAD_ERR_OK) {
        $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
        if ($check !== false) {
            if ($_FILES["profile_picture"]["size"] <= 5000000 && 
                in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
                if (!file_exists($targetFile)) {
                    if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $targetFile)) {
                        $profilePicture = $conn->real_escape_string($targetFile);
                        // Insert into database
                        $stmt = $conn->prepare("INSERT INTO users (username, email, password, profile_picture) VALUES (?, ?, ?, ?)");
                        $stmt->bind_param("ssss", $username, $email, $hashed_password, $profilePicture);
                        if ($stmt->execute()) {
                            echo "<div id=''></div>";
                        } else {
                            echo "" . $stmt->error;
                        }
                        $stmt->close();
                    } else {
                        echo "Error uploading file.";
                    }
                } else {
                    echo "File already exists.";
                }
            } else {
                echo "Invalid file size or type.";
            }
        } else {
            echo "File is not an image.";
        }
    } else {
        echo "Error with file upload: " . $_FILES["profile_picture"]["error"];
    }
}

$conn->close();

$messages = ob_get_clean();
?>


<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szmejenger - Rejestracja</title>
    <link rel="stylesheet" href="style1 (2).css">
    <script src="skryptyIndex.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" 
          integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" 
          crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<main id="log">
    <form action="rejestracja.php" method="post" enctype="multipart/form-data">
        <p>Zarejestruj się na stronie</p>
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <label for="file-input">Dodaj foto:&nbsp;&nbsp;<i class="fa-solid fa-image"></i></label><br>
        <input type="file" id="file-input" accept="image/jpeg, image/png, image/jpg, image/gif" name="profile_picture" required><br>
        <input type="submit" value="Rejestracja">
        <p>
            Masz konto?
            <a href="index.php">Zaloguj się</a>
        </p>
    </form>
</main>
</body>
</html>
