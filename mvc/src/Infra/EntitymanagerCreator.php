<?php

namespace Alura\Armazenamento\Infra;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;

class EntitymanagerCreator
{
    public function getEntityManager(): EntityManagerInterface
    {
        $config = Setup::createAnnotationMetadataConfiguration([__DIR__ . '/../Entity'], true);
        $dadosConexao = [
            'driver' => 'pdo_mysql',
            'host' => 'localhost',
            'password' => '123',
            'user' => 'root',
            'dbname' => 'cursos'
        ];

        return EntityManager::create($dadosConexao, $config);
    }
}
