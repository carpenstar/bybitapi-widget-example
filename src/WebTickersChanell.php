<?php
namespace Source;

use Carpenstar\ByBitAPI\WebSockets\Objects\Channels\DefaultChannelHandler;
use WebSocket\Client;
use WebSocket\Exception;
use WebSocket\Server;

class WebTickersChanell extends DefaultChannelHandler
{
    private Server $server;

    public function __construct(Server $server)
    {
        $this->server = $server;
    }

    public function handle($data): void
    {
         $ticker = json_decode($data);
         if (!empty($ticker->data)) {
             try {
                 $this->server->send(json_encode([
                     'symbol' => $ticker->data->s,
                     'price' => $ticker->data->c,
                     'volume' => $ticker->data->v
                 ]), 'text', false);
             } catch (Exception $e) {}
         }
    }
}