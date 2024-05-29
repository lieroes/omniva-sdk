<?php

namespace Lieroes\OmnivaSDK\Infrastructure\Logging;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LoggerFactory
{
    public static function createLogger(string $name): Logger
    {
        $logger = new Logger($name);
        $logger->pushHandler(new StreamHandler(__DIR__ . '/../../../logs/app.log', Logger::DEBUG));
        return $logger;
    }
}
