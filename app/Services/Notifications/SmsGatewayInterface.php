<?php

namespace App\Services\Notifications;

interface SmsGatewayInterface
{
    /**
     * @return array{success: bool, error: ?string}
     */
    public function send(string $to, string $message): array;
}
