<?php
include 'database.php'; // Подключение к базе данных

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Хеширование пароля

    // Проверка на существование имени пользователя
    $stmt = $db->prepare('SELECT * FROM users WHERE username = :username');
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $result = $stmt->execute();

    if ($result->fetchArray()) {
        echo "Имя пользователя уже занято.";
    } else {
        // Вставка данных в таблицу
        $stmt = $db->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
        $stmt->bindValue(':username', $username, SQLITE3_TEXT);
        $stmt->bindValue(':password', $password, SQLITE3_TEXT);

        if ($stmt->execute()) {
            echo "Регистрация успешна. Теперь вы можете войти.";
        } else {
            echo "Ошибка при регистрации.";
        }
    }
}
?>
