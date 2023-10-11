<?php

namespace App\Websocket;

use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

/**
 * Class ServerFactory
 *
 * @package App\Websocket
 * @author Jérémy GUERIBA
 */
class WebsocketServerFactory
{
    public static function create(int $port): IoServer
    {
        return IoServer::factory(new HttpServer(new WsServer(new MessageHandler(new \SplObjectStorage()))), $port);
    }
}