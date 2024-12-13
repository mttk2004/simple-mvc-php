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

    public function __invoke(UserLoggedIn $event): void
    {
        // Ghi log khi người dùng đăng nhập
        $this->logger->info("User {$event->getUserId()} logged in.");
    }
}
