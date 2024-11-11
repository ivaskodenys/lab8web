<?php
// 1. Отримуємо дані JSON за допомогою file_get_contents()
$url = 'http://lab.vntu.org/api-server/lab8.php?user=student&pass=p@ssw0rd';
$json_data = file_get_contents($url);

// Перевірка на помилки отримання даних
if ($json_data === false) {
    die("Помилка при отриманні даних з API.");
}

// 2. Перетворюємо JSON на PHP-об’єкти
$data = json_decode($json_data);

// Перевірка на помилки парсингу JSON
if ($data === null) {
    die("Помилка при парсингу JSON. Перевірте формат відповіді.");
}

// 3. Об’єднуємо всі записи про людей в один масив
$people = [];
foreach ($data as $group) {
    foreach ($group as $person) {
        $people[] = $person; // Додаємо кожного людину з групи в загальний масив
    }
}

// Виводимо таблицю в HTML
echo '<table border="1">';
echo '<tr><th>Ім’я</th><th>Принадлежність</th><th>Ранг</th><th>Місце</th></tr>';

foreach ($people as $person) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($person->name) . '</td>';
    echo '<td>' . htmlspecialchars($person->affiliation) . '</td>';
    echo '<td>' . htmlspecialchars($person->rank) . '</td>';
    echo '<td>' . htmlspecialchars($person->location) . '</td>';
    echo '</tr>';
}

echo '</table>';
?>
