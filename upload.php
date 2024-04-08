<?php
$targetDirectory = "uploads/"; // директорія, куди буде збережено завантажений файл

if(isset($_POST["submit"])) {
    $targetFile = $targetDirectory . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

    // Перевірка, чи є файл справжнім файлом зображення
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "Файл є файлом зображення - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "Файл не є файлом зображення.";
            $uploadOk = 0;
        }
    }

    // Перевірка, чи файл вже існує
    if (file_exists($targetFile)) {
        echo "Вибачте, файл вже існує.";
        $uploadOk = 0;
    }

    // Перевірка розміру файлу
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Вибачте, ваш файл занадто великий.";
        $uploadOk = 0;
    }

    // Дозволені формати файлів
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    if(!in_array($imageFileType, $allowedExtensions)) {
        echo "Дозволені тільки JPG, JPEG, PNG та GIF файли.";
        $uploadOk = 0;
    }

    // Завантаження файлу, якщо всі перевірки пройдено успішно
    if ($uploadOk == 0) {
        echo "Вибачте, ваш файл не було завантажено.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            echo "Файл ". basename( $_FILES["fileToUpload"]["name"]). " успішно завантажено.";
        } else {
            echo "Виникла помилка при завантаженні вашого файлу.";
        }
    }
}
?>
