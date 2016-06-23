<?php 
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
 
$paths = array("/entities");
$isDevMode = false;
 
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => '',
    'dbname'   => 'nuevoencuentro',
    'host'     => 'localhost'
);
 
$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);