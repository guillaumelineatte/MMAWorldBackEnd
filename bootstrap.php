<?php
// bootstrap.php
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require_once "vendor/autoload.php";

$isDevMode = false;
$proxyDir = false;
$cache = null;

$dbParams = array(
    'driver' => 'pdo_mysql',
    'user' => 'guillaume',
    'password' => 'plop',
    'dbname' => 'BTS_Guillaume',
);
$useSimpleAnnotationReader = false;

$config = ORMSetup::createAttributeMetadataConfiguration(
    array(__DIR__."/src"), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);

$entityManager = EntityManager::create($dbParams, $config);
