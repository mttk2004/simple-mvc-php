<?php

namespace Listeners;

use League\Event\Listener;
use Events\UserLoggedIn;
use Monolog\Logger;

class UserLoggedInListener implements Listener
{
    private Logger $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(object $event): void
    {
        // Kiểm tra kiểu của sự kiện
        if ($event instanceof UserLoggedIn) {
            // Ghi log khi người dùng đăng nhập
            $this->logger->info("User {$event->getUserId()} logged in.");
        }
    }
} 