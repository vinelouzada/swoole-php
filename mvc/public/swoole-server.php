<?php

use Nyholm\Psr7\ServerRequest;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Http\Server;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

require __DIR__ . '/../vendor/autoload.php';
$rotas = require __DIR__ . '/../config/rotas.php';
/** @var ContainerInterface $container */
$container = require __DIR__ . '/../config/dependencias.php';
ini_set('error_reporting', E_ALL);


$servidor = new Server('localhost', '8080');
$servidor->set(['hook_flags' => SWOOLE_HOOK_ALL]);

$servidor->on(
    'request',
    function (Request $requesicao, Response $resposta ) use($container, $rotas){

    $path = $requesicao->server['path_info'] ?? '/';


    if ($path === '/') {
        $resposta->redirect('Location: /listar-cursos');
        return;
    }

    if (!isset($rotas[$path])) {
        $resposta->setStatusCode(404);
        return;
    }

//    session_start();
//    if (!isset($_SESSION['logado']) && stripos($path, 'login') === false) {
//        $_SESSION['tipo_mensagem'] = 'danger';
//        $_SESSION['mensagem_flash'] = 'Você não está logado';
//        header('Location: /login');
//        exit();
//    }

    $controllerClass = $rotas[$path];


    $serverRequest = (new ServerRequest(
        $requesicao->getMethod(),
        $requesicao->server['request_uri'],
        $requesicao->header,
        $requesicao->getData(),
        serverParams: $requesicao->server
    ))->withQueryParams($requesicao->get ??  [])->withParsedBody($requesicao->post ??  []);



    /** @var RequestHandlerInterface $controllerInstance */
    $controllerInstance = $container->get($controllerClass);

    $responsePsr7 = $controllerInstance->handle($serverRequest);

    foreach ($responsePsr7->getHeaders() as $header => $valores) {

        if ($header === 'Location'){
            $resposta->redirect($valores[0]);
        }

        foreach ($valores as $value) {
            $resposta->header($header, $value);
        }
    }

    $resposta->end($responsePsr7->getBody());

});

$servidor->start();