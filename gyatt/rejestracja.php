<?php
$conn = new mysqli("localhost", "root", "", "messenger_clone");

// Sprawdzenie połączenia
if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

// Sprawdzenie, czy formularz został wysłany
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $profile_picture = null;

    // Obsługa przesyłania zdjęcia
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $fileName = uniqid() . '_' . basename($_FILES['profile_picture']['name']);
        $uploadFile = $uploadDir . $fileName;

        // Sprawdzenie typu pliku
        $fileType = mime_content_type($_FILES['profile_picture']['tmp_name']);
        if (in_array($fileType, ['image/jpeg', 'image/png', 'image/gif'])) {
            if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $uploadFile)) {
                $profile_picture = $uploadFile;
            } else {
                echo "Błąd podczas przesyłania pliku.";
                exit();
            }
        } else {
            echo "Akceptowane są jedynie pliki w formatach JPEG, PNG lub GIF.";
            exit();
        }
    }

    // Tworzenie zapytania SQL
    $sql = "INSERT INTO users (username, email, password, profile_picture) VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $username, $email, $hashed_password, $profile_picture);

    if ($stmt->execute()) {
        header("Location: index.php"); // Przekierowanie do logowania
        exit();
    } else {
        echo "Błąd: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Szmejenger - rejestracja</title>
		<link rel="stylesheet" href="style1 (2).css" />
		<script src="skryptyIndex.js"></script>
		<link
			rel="stylesheet"
			href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
			integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
			crossorigin="anonymous"
			referrerpolicy="no-referrer"
		/>
	</head>
	<body>
		<main id="log">
			<form action="rejestracja.php" method="post">
				<p>zarejestruj się na stronie</p>
				<input type="text" name="username" placeholder="Username" required><br>
				<input type="email" name="email" placeholder="Email" required><br>
				<input type="password" name="password" placeholder="Password" required><br>
				<label for="file-input"
					>Dodaj foto:&nbsp;&nbsp;<i class="fa-solid fa-image"></i></label
				><br />
				<input
					type="file"
					class="sigma"
					id="file-input"
					accept="image/jpeg, image/png, image/jpg, image/gif"
					name="profile_picture"
				/><br />
				<button type="submit">Rejestracja</button>
				<p>
					Masz konto?
					<a href="index.php">Zaloguj się</a>
				</p>
			</form>
		</main>
	</body>
</html>
