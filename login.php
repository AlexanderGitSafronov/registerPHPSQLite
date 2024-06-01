<?php
include 'database.php'; // Подключение к базе данных

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Проверка имени пользователя и пароля
    $stmt = $db->prepare('SELECT * FROM users WHERE username = :username');
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $result = $stmt->execute();

    $user = $result->fetchArray();
    if ($user) {
        if (password_verify($password, $user['password'])) {
            echo "Авторизация успешна. Добро пожаловать, " . $user['username'] . "!";
        } else {
            echo "Неверный пароль.";
        }
    } else {
        echo "Пользователь не найден.";
    }
}
?>
