<?php

use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Http\Server;

$servidor = new Server('localhost','8080');

$servidor->on('request', function (Request $requesicao, Response $resposta){
   $resposta->end('gg');
});

$servidor->start();