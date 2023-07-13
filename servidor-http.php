<?php

use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Http\Server;

$servidor = new Server('localhost','8080');

$servidor->on('request', function (Request $requesicao, Response $resposta){
    $resultado = [];
    Co::join([
       go(function () use (&$resultado){
           $cliente = new \Swoole\Coroutine\Http\Client('localhost',8081);
           $cliente->get('/servidor-delay.php');
           $conteudo = $cliente->getBody();

           $resultado['servidor-delay'] = $conteudo;
       }),
       go(function () use (&$resultado){
           $conteudo = file_get_contents('registros.txt');
           $resultado['registros'] = $conteudo;
       })
    ]);

    $resposta->end(json_encode($resultado));

});

$servidor->start();