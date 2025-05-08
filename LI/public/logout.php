<?php
// Старт сессии
session_start();

// Удаляем все данные из сессии
session_unset();

// Разрушаем сессию
session_destroy();

// Перенаправляем пользователя на страницу входа
header("Location: login.php");
exit;
