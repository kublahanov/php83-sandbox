<?php
$dbConfig = getenv('DB_DATABASE');
$dbUser = getenv('DB_USERNAME');
$dbPass = getenv('DB_PASSWORD');
$dbHost = getenv('DB_HOST');
$dbPort = getenv('DB_PORT');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 8.3 Sandbox</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'gradient': 'gradient 8s linear infinite',
                        'float': 'float 6s ease-in-out infinite',
                    },
                    keyframes: {
                        gradient: {
                            '0%, 100%': {
                                'background-size': '200% 200%',
                                'background-position': 'left center'
                            },
                            '50%': {
                                'background-size': '200% 200%',
                                'background-position': 'right center'
                            },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="text-center mb-12 animate-float">
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white p-8 rounded-2xl shadow-2xl mb-6">
            <i class="fas fa-rocket text-4xl mb-4"></i>
            <h1 class="text-4xl md:text-5xl font-bold mb-2">PHP 8.3 Sandbox</h1>
            <p class="text-blue-100 text-lg">Добро пожаловать в вашу среду разработки!</p>
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-8 mb-8">
        <!-- Системная информация -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                Системная информация
            </h2>
            <div class="space-y-3">
                <div class="flex justify-between items-center p-3 bg-blue-50 rounded-lg">
                    <span class="font-medium text-gray-700">PHP Version:</span>
                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">
                            <?php echo phpversion(); ?>
                        </span>
                </div>
                <div class="flex justify-between items-center p-3 bg-green-50 rounded-lg">
                    <span class="font-medium text-gray-700">Web Server:</span>
                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">
                            <?php echo $_SERVER['SERVER_SOFTWARE'] ?? 'N/A'; ?>
                        </span>
                </div>
                <div class="p-3 bg-purple-50 rounded-lg">
                    <span class="font-medium text-gray-700 block mb-1">Document Root:</span>
                    <code class="text-sm text-purple-700 bg-purple-100 px-2 py-1 rounded"><?php echo $_SERVER['DOCUMENT_ROOT'] ?? 'N/A'; ?></code>
                </div>
            </div>
        </div>

        <!-- Проверка расширений -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-plug text-green-500 mr-2"></i>
                Проверка расширений
            </h2>
            <div class="grid grid-cols-2 gap-3">
                <?php
                $extensions = [
                    'pdo' => ['PDO', 'blue'],
                    'pdo_pgsql' => ['PDO PostgreSQL', 'green'],
                    'redis' => ['Redis', 'red'],
                    'bcmath' => ['BCMath', 'purple']
                ];

                foreach ($extensions as $ext => [$name, $color]) {
                    $loaded = extension_loaded($ext);
                    $bgColor = $loaded ? "bg-{$color}-100 text-{$color}-800" : "bg-gray-100 text-gray-500";
                    $icon = $loaded ? 'fa-check-circle' : 'fa-times-circle';
                    $iconColor = $loaded ? "text-{$color}-500" : "text-gray-400";
                    ?>
                    <div class="flex items-center p-3 rounded-lg <?php echo $bgColor; ?>">
                        <i class="fas <?php echo $icon; ?> <?php echo $iconColor; ?> mr-2"></i>
                        <span class="font-medium"><?php echo $name; ?></span>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Проверка БД -->
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-amber-500 mb-8">
        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-database text-amber-500 mr-2"></i>
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
                            <div class="text-gray-500">База данных</div>
                            <div class="font-semibold"><?php echo $dbName; ?></div>
                        </div>
                        <div class="bg-white p-3 rounded-lg">
                            <div class="text-gray-500">Пользователь</div>
                            <div class="font-semibold"><?php echo $user; ?></div>
                        </div>
                        <div class="bg-white p-3 rounded-lg">
                            <div class="text-gray-500">Версия</div>
                            <div class="font-semibold text-xs"><?php echo explode(' ', $version)[0]; ?></div>
                        </div>
                    </div>
                </div>
                <?php
            } catch (PDOException $e) {
                ?>
                <div class="flex items-center text-red-600 font-semibold">
                    <i class="fas fa-times-circle mr-2"></i>
                    Ошибка подключения: <?php echo $e->getMessage(); ?>
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- Дополнительные ссылки -->
    <div class="text-center">
        <a href="/test.php"
           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
            <i class="fas fa-code mr-2"></i>
            Полная информация PHP (phpinfo)
        </a>
    </div>

    <!-- Footer -->
    <div class="text-center mt-12 text-gray-500">
        <p>С любовью ❤️ для разработчиков</p>
    </div>
</div>
</body>
</html>
