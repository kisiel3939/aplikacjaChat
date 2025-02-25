<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Szmejenger - rejestracja</title>
		<link rel="stylesheet" href="style.css" />
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
			<form action="" method="post">
				<p>zarejestruj się na stronie</p>
				<input type="text" name="rejestracja" id="login" /><br />
				<input type="password" name="rejestracja" id="password" /><br />
				<label for="file-input"
					>dodaj foto:&nbsp;&nbsp;<i class="fa-solid fa-image"></i></label
				><br />
				<input
					type="file"
					class="sigma"
					id="file-input"
					accept="image/jpeg, image/png, image/jpg, image/gif"
				/><br />
				<input
					type="button"
					value="rejestracja"
					id="login-btn"
					onclick="rejestracjaKonta()"
				/>
				<p>
					masz konto?
					<a href="logowanie.html">zaloguj się</a>
				</p>
			</form>
		</main>
	</body>
</html>
