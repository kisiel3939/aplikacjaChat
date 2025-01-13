<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Messenger Clone</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  <div class="messenger-container">
    <div class="users-list">
      
    </div>

    <div class="chat-area">
      
      
      <div class="chat-input">
        <label for="file-input"><i class="fa-solid fa-image"></i></label><br>
        <input type="file" class="sigma" id="file-input" accept="image/jpeg, image/png, image/jpg, image/gif">
        <input type="text" placeholder="Type a message...">
        <button>Wyślij</button>
      </div>
    </div>
  </div>
</body>
</html>
