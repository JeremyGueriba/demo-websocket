<?php

namespace App\Websocket;

use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

/**
 * Class MessageHandler
 *
 * @package App\Websocket
 * @author Jérémy GUERIBA
 */
class MessageHandler implements MessageComponentInterface
{
    public function __construct(private \SplObjectStorage $connections)
    {
    }

    public function onOpen(ConnectionInterface $connection): void
    {
        $this->connections->attach($connection);
    }

    public function onMessage(ConnectionInterface $from, $message): void
    {
        foreach ($this->connections as $connection) {
            if ($from != $connection) {
                $connection->send($message);
            }
        }
    }

    public function onClose(ConnectionInterface $connection): void
    {
        $this->connections->detach($connection);
    }

    public function onError(ConnectionInterface $connection, \Exception $e): void
    {
        $this->connections->detach($connection);
        $connection->close();
    }
}