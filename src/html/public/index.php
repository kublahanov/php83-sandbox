<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 83 Sandbox</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { color: #333; border-bottom: 2px solid #007cba; padding-bottom: 10px; }
        .info { background: #e7f3ff; padding: 15px; border-radius: 5px; margin: 20px 0; }
        .success { color: #2ecc71; font-weight: bold; }
    </style>
</head>
<body>
<div class="container">
    <h1>🚀 PHP 8.3 Sandbox</h1>

    <div class="info">
        <h2>Системная информация:</h2>
        <p><strong>PHP Version:</strong> <?php echo phpversion(); ?></p>
        <p><strong>Server Software:</strong> <?php echo $_SERVER['SERVER_SOFTWARE'] ?? 'N/A'; ?></p>
        <p><strong>Document Root:</strong> <?php echo $_SERVER['DOCUMENT_ROOT'] ?? 'N/A'; ?></p>
    </div>

    <h2>Проверка расширений:</h2>
    <ul>
        <li>PDO: <?php echo extension_loaded('pdo') ? '✅' : '❌'; ?></li>
        <li>PDO PostgreSQL: <?php echo extension_loaded('pdo_pgsql') ? '✅' : '❌'; ?></li>
        <li>Redis: <?php echo extension_loaded('redis') ? '✅' : '❌'; ?></li>
        <li>BCMath: <?php echo extension_loaded('bcmath') ? '✅' : '❌'; ?></li>
    </ul>

    <h2>Проверка БД:</h2>
    <?php
    try {
        $pdo = new PDO(
            "pgsql:host=postgres;dbname=<?php echo getenv('DB_DATABASE') ?: 'php83_sandbox'; ?>",
            "<?php echo getenv('DB_USERNAME') ?: 'php83_sandbox_user'; ?>",
            "<?php echo getenv('DB_PASSWORD') ?: 'php83_sandbox_password'; ?>"
        );
        echo '<p class="success">✅ Подключение к PostgreSQL успешно!</p>';
    } catch (PDOException $e) {
        echo '<p style="color: #e74c3c;">❌ Ошибка подключения: ' . $e->getMessage() . '</p>';
    }
    ?>

    <h2>Доступные endpoints:</h2>
    <ul>
        <li><a href="/">Главная страница</a></li>
        <li><a href="/test.php">Тест PHP</a></li>
        <li><a href="/api">API (будет позже)</a></li>
    </ul>
</div>
</body>
</html>
