<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Szmejenger - logowanie</title>
		<link rel="stylesheet" href="style.css" />
		<script src="skryptyIndex.js"></script>
	</head>
	<body>
		<main id="log">
			<form action="" method="post">
				<p>zaloguj się na stronie</p>
				<input type="text" name="logowanie" id="login" /><br />
				<input type="password" name="logowanie" id="password" /><br />
				<input
					type="button"
					value="Zaloguj"
					id="login-btn"
					onclick="zaloguj()"
				/>
				<p>
					nie masz konta?
					<a href="rejestracja.html">załóż konto</a>
				</p>
			</form>
		</main>
	</body>
</html>
