<?php
session_start();

$conn = new mysqli("localhost", "root", "", "messenger_clone");

// Sprawdzenie połączenia
if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

// Pobieranie danych z formularza
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Pobranie danych użytkownika z bazy danych
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $username, $hashed_password);
        $stmt->fetch();

        // Sprawdzenie poprawności hasła
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            header("Location: main.php"); // Przekierowanie do strony głównej
            exit();
        } else {
            echo "Niepoprawne hasło!";
        }
    } else {
        echo "Nie znaleziono użytkownika o podanym adresie email!";
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
		<title>Szmejenger - logowanie</title>
		<link rel="stylesheet" href="style1 (2).css" />
		<script src="skryptyIndex.js"></script>
	</head>
	<body>
		<main id="log">
			<form method="POST">
				<input type="email" name="email" placeholder="Email" required><br>
				<input type="password" name="password" placeholder="Password" required><br>
				<button type="submit">Log In</button>
				<p>
					nie masz konta?
					<a href="rejestracja.php">załóż konto</a>
				</p>
			</form>
		</main>
	</body>
</html>
