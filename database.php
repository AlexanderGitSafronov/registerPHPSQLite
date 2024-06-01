<?php
$db = new SQLite3('users.db');

// Создание таблицы пользователей
$query = 'CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL
)';
$db->exec($query);
?>
