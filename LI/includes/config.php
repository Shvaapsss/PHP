<?php
$conn = new mysqli("localhost", "root", "", "appdb");
if ($conn->connect_error) die("Ошибка подключения");
