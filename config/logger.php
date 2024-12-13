<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// Tạo logger
$logger = new Logger('user_logger');

// Thêm handler để ghi log vào file
$logger->pushHandler(new StreamHandler(BASE_PATH . 'storage/logs/app.log', Logger::INFO));

return $logger;
