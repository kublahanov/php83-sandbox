<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 8.3 Sandbox</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background: #f5f5f5;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            padding-bottom: 10px;
        }

        .info {
            background: #e7f3ff;
            padding: 15px;
            border-radius: 10px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>🚀 PHP 8.3 Sandbox</h1>

    <div class="info">
        <h2>Системная информация:</h2>
        <ul>
            <li><strong>PHP version:</strong> <?php echo phpversion(); ?>.</li>
            <li><strong>Web server:</strong> <?php echo $_SERVER['SERVER_SOFTWARE'] ?? 'N/A'; ?>.</li>
            <li><strong>Document root:</strong> <?php echo $_SERVER['DOCUMENT_ROOT'] ?? 'N/A'; ?>.</li>
        </ul>
    </div>

    <h2>Проверка расширений:</h2>
    <ul>
        <li>PDO: <?php echo extension_loaded('pdo') ? ' ✅ ' : ' ❌ '; ?></li>
        <li>PDO PostgreSQL: <?php echo extension_loaded('pdo_pgsql') ? ' ✅ ' : ' ❌ '; ?></li>
        <li>Redis: <?php echo extension_loaded('redis') ? ' ✅ ' : ' ❌ '; ?></li>
        <li>BCMath: <?php echo extension_loaded('bcmath') ? ' ✅ ' : ' ❌ '; ?></li>
    </ul>

    <h2>Проверка БД:</h2>
    <?php
    $dbConfig = getenv('DB_DATABASE') ?: 'php83_sandbox';
    $dbUser = getenv('DB_USERNAME') ?: 'php83_sandbox_user';
    $dbPass = getenv('DB_PASSWORD') ?: 'php83_sandbox_password';

    try {
        $pdo = new PDO(
            "pgsql:host=postgres;dbname=$dbConfig",
            $dbUser,
            $dbPass,
        );
        echo '<ul><li>Подключение к PostgreSQL успешно! ✅ </li></ul>';
    } catch (PDOException $e) {
        echo '<ul><li>Ошибка подключения: ' . $e->getMessage() . '. ❌ </li></ul>';
    }
    ?>

    <h2>Полная информация по PHP:</h2>
    <ul>
        <li><a href="/test.php">php_info()</a></li>
    </ul>
</div>
</body>
</html>
