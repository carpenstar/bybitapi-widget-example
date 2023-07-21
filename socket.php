<?php
require_once "./vendor/autoload.php";

use Carpenstar\ByBitAPI\BybitAPI;
use Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\Tickers\TickersChannel;
use Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\Tickers\Argument\TickersArgument;
use Source\WebTickersChanell;
use WebSocket\Server;

$server = new Server(['port' => 8001]);
$server->setTimeout(86400);

(new BybitAPI(getenv("BYBIT_HOST"), getenv("BYBIT_APIKEY"), getenv("BYBIT_SECRET")))
    ->websocket(
        TickersChannel::class,
        new TickersArgument(getenv("SYMBOL")),
        new WebTickersChanell($server)
    );