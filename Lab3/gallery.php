<?php
// Задаем путь к папке с изображениями
$dir = 'image/';
// Сканируем содержимое директории
$files = scandir($dir);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Apple Image Gallery</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #4CAF50;
            color: white;
            padding: 1rem;
            text-align: center;
        }
        nav {
            background-color: #333;
            overflow: hidden;
        }
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        nav li {
            float: left;
        }
        nav li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        nav li a:hover {
            background-color: #111;
        }
        .gallery {
            display: flex;
            flex-wrap: wrap;
            padding: 20px;
            justify-content: center;
        }
        .gallery img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            margin: 10px;
            border: 2px solid #ddd;
            border-radius: 5px;
            transition: transform 0.3s;
        }
        .gallery img:hover {
            transform: scale(1.05);
            border-color: #4CAF50;
        }
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 1rem;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to the Green Apple Image Gallery</h1>
    </header>
    
    <nav>
        <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="#gallery">Gallery</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
    </nav>
    
    <section id="gallery" class="gallery">
        <h2 style="width: 100%; text-align: center;">Green Apples Image Gallery</h2>
        <?php
        if ($files !== false) {
            foreach ($files as $file) {
                if ($file != "." && $file != ".." && pathinfo($file, PATHINFO_EXTENSION) == 'jpg') {
                    echo "<img src='$dir$file' alt='Green Apple'>";
                }
            }
        }
        ?>
    </section>
    
    <footer>
        <p>&copy; <?= date('Y') ?> Green Apple Image Gallery. All rights reserved.</p>
    </footer>
</body>
</html>
