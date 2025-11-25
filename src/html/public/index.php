<?php

$dbConfig = getenv('DB_DATABASE');
$dbUser = getenv('DB_USERNAME');
$dbPass = getenv('DB_PASSWORD');
$dbHost = getenv('DB_HOST');
$dbPort = getenv('DB_PORT');

$composerVersion = 'N/A';
$composerCheck = shell_exec('composer --version 2>&1');

if (preg_match('/Composer version ([0-9.]+)/', $composerCheck, $matches)) {
    $composerVersion = $matches[1];
}

$title = 'PHP 8.3 Sandbox';

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <!-- Tailwind CSS -->
    <link href="/assets/css/tailwind.css" rel="stylesheet">
    <!-- Кастомные стили -->
    <link href="/assets/css/custom.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/assets/fonts/fontawesome/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
<div class="container mx-auto px-4 py-8 max-w-5xl">
    <!-- Шапка -->
    <div class="text-center mb-12 animate-float">
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white p-8 rounded-2xl shadow-2xl mb-6">
            <i class="fas fa-rocket text-4xl mb-4"></i>
            <h1 class="text-4xl md:text-5xl font-bold mb-2"><?php echo $title; ?></h1>

            <!-- Приветствие -->
            <p class="text-blue-100 text-lg mt-8">Добро пожаловать!</p>
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-8 mb-8">
        <!-- Системная информация -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-info-circle text-blue-500 mr-3"></i>
                Системная информация
            </h2>
            <div class="space-y-3">
                <div class="flex justify-between items-center p-3 bg-blue-50 rounded-lg">
                    <span class="font-medium text-gray-700">PHP Version:</span>
                    <span class="text-blue-800 bg-blue-100 px-3 py-1 rounded-full text-sm font-semibold">
                        <?php echo phpversion(); ?>
                    </span>
                </div>
                <div class="flex justify-between items-center p-3 bg-purple-50 rounded-lg">
                    <span class="font-medium text-gray-700">Composer Version:</span>
                    <span class="text-purple-800 bg-purple-100 px-3 py-1 rounded-full text-sm font-semibold">
                        <?php echo $composerVersion; ?>
                    </span>
                </div>
                <div class="flex justify-between items-center p-3 bg-green-50 rounded-lg">
                    <span class="font-medium text-gray-700">Web Server:</span>
                    <span class="text-green-800 bg-green-100 px-3 py-1 rounded-full text-sm">
                        <?php echo $_SERVER['SERVER_SOFTWARE'] ?? 'N/A'; ?>
                    </span>
                </div>
                <div class="flex justify-between items-center p-3 bg-red-50 rounded-lg">
                    <span class="font-medium text-gray-700">Document Root:</span>
                    <code class="text-red-700 bg-red-100 px-3 py-1 rounded-full text-xs">
                        <?php echo $_SERVER['DOCUMENT_ROOT'] ?? 'N/A'; ?>
                    </code>
                </div>
            </div>
        </div>

        <!-- Проверка расширений -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-plug text-green-500 mr-3"></i>
                Проверка расширений
            </h2>
            <div class="grid grid-cols-2 gap-3">
                <?php
                $extensions = [
                    'pdo' => ['PDO', 'blue'],
                    'pdo_pgsql' => ['PDO PostgreSQL', 'green'],
                    'redis' => ['Redis', 'red'],
                    'bcmath' => ['BCMath', 'purple'],
                    // 'non-existent extension' => ['Non-existent extension', 'black'],
                ];

                foreach ($extensions as $ext => [$name, $color]) {
                    $loaded = extension_loaded($ext);
                    $bgColor = $loaded ? "bg-{$color}-100 text-{$color}-800" : "bg-gray-100 text-gray-500";
                    $icon = $loaded ? 'fa-check-circle' : 'fa-times-circle';
                    $iconColor = $loaded ? "text-{$color}-500" : "text-gray-400";
                    ?>
                    <div class="flex items-center p-3 rounded-lg <?php echo $bgColor; ?>">
                        <i class="fas <?php echo $icon; ?> <?php echo $iconColor; ?> mr-3"></i>
                        <span class="font-medium truncate sm:overflow-visible sm:whitespace-normal">
                            <?php echo $name; ?>
                        </span>
                    </div>
                <?php } ?>
            </div>
            <div class="grid grid-cols-1 mt-4">
                <a href="/test.php"
                   class="flex items-center p-4 bg-blue-50 rounded-lg border border-blue-200 hover:bg-blue-100 transition-colors group">
                    <div class="bg-blue-100 p-3 rounded-lg mr-4">
                        <i class="fas fa-code text-blue-600"></i>
                    </div>
                    <div>
                        <div class="font-semibold text-gray-800">PHP Information</div>
                        <div class="text-sm text-gray-600">Полная информация о PHP</div>
                    </div>
                    <i class="fas fa-chevron-right text-blue-400 ml-auto group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Проверка подключения к БД -->
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-amber-500 mb-8">
        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-database text-amber-500 mr-3"></i>
            Проверка подключения к БД
        </h2>
        <div class="bg-amber-50 rounded-lg p-4">
            <?php
            try {
                $pdo = new PDO(
                    "pgsql:host=$dbHost;port=$dbPort;dbname=$dbConfig",
                    $dbUser,
                    $dbPass
                );

                // Получаем дополнительную информацию
                $version = $pdo->query('SELECT version()')->fetchColumn();
                $dbName = $pdo->query('SELECT current_database()')->fetchColumn();
                $user = $pdo->query('SELECT current_user')->fetchColumn();
                ?>
                <div class="space-y-3">
                    <div class="flex items-center text-green-600 font-semibold">
                        <i class="fas fa-check-circle mr-2"></i>
                        Подключение к PostgreSQL успешно!
                    </div>
                    <div class="grid md:grid-cols-3 gap-4 text-sm">
                        <div class="bg-white p-3 rounded-lg">
                            <div class="text-gray-500">База данных:</div>
                            <div class="font-semibold"><?php echo $dbName; ?></div>
                        </div>
                        <div class="bg-white p-3 rounded-lg">
                            <div class="text-gray-500">Пользователь:</div>
                            <div class="font-semibold"><?php echo $user; ?></div>
                        </div>
                        <div class="bg-white p-3 rounded-lg">
                            <div class="text-gray-500">Версия:</div>
                            <div class="font-semibold text-sm">
                                <?php echo explode(' ', $version)[0]; ?>
                                <?php echo explode(' ', $version)[1]; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            } catch (PDOException $e) {
                ?>
                <div class="flex items-center text-red-600 font-semibold">
                    <i class="fas fa-times-circle mr-2"></i>
                    Ошибка подключения: <?php echo $e->getMessage(); ?>.
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- Полезные ссылки -->
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500 mt-8">
        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-external-link-alt text-purple-500 mr-3"></i>
            Полезные ссылки
        </h2>
        <div class="grid md:grid-cols-2 gap-4">
            <a href="https://kublahanov.github.io/php83-sandbox/"
               class="flex items-center p-4 bg-blue-50 rounded-lg border border-blue-200 hover:bg-blue-100 transition-colors group">
                <div class="bg-blue-100 p-3 rounded-lg mr-4">
                    <i class="fas fa-code text-blue-600"></i>
                </div>
                <div>
                    <div class="font-semibold text-gray-800">Home Page</div>
                    <div class="text-sm text-gray-600">Страница проекта</div>
                </div>
                <i class="fas fa-external-link-alt text-purple-400 ml-auto"></i>
            </a>

            <a href="https://github.com/kublahanov/php83-sandbox"
               target="_blank"
               class="flex items-center p-4 bg-purple-50 rounded-lg border border-purple-200 hover:bg-purple-100 transition-colors group">
                <div class="bg-purple-100 p-3 rounded-lg mr-4">
                    <i class="fab fa-github text-purple-600"></i>
                </div>
                <div>
                    <div class="font-semibold text-gray-800">GitHub Repository</div>
                    <div class="text-sm text-gray-600">Исходный код проекта</div>
                </div>
                <i class="fas fa-external-link-alt text-purple-400 ml-auto"></i>
            </a>

            <a href="https://github.com/kublahanov/php83-sandbox/blob/main/README.md"
               target="_blank"
               class="flex items-center p-4 bg-green-50 rounded-lg border border-green-200 hover:bg-green-100 transition-colors group">
                <div class="bg-green-100 p-3 rounded-lg mr-4">
                    <i class="fas fa-book text-green-600"></i>
                </div>
                <div>
                    <div class="font-semibold text-gray-800">Documentation</div>
                    <div class="text-sm text-gray-600">README и документация</div>
                </div>
                <i class="fas fa-external-link-alt text-green-400 ml-auto"></i>
            </a>

            <a href="https://github.com/kublahanov/php83-sandbox/issues"
               target="_blank"
               class="flex items-center p-4 bg-red-50 rounded-lg border border-red-200 hover:bg-red-100 transition-colors group">
                <div class="bg-red-100 p-3 rounded-lg mr-4">
                    <i class="fas fa-bug text-red-600"></i>
                </div>
                <div>
                    <div class="font-semibold text-gray-800">Report Issues</div>
                    <div class="text-sm text-gray-600">Сообщить об ошибках</div>
                </div>
                <i class="fas fa-external-link-alt text-red-400 ml-auto"></i>
            </a>
        </div>
    </div>

    <!-- Подвал -->
    <footer class="text-center mt-12 text-gray-500">
        <p>
            &copy; From
            <a class="underline hover:no-underline" href="https://github.com/kublahanov">kublahanov</a>
            with ❤️!
        </p>
    </footer>
</div>
</body>
</html>
