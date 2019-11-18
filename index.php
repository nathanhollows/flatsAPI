<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

use Phalcon\Loader;
use Phalcon\Mvc\Micro;
use Phalcon\Di\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as PdoMysql;

$loader = new Loader();

$loader->registerNamespaces( 
    [
        'App\Models' => __DIR__ . '/models/',
    ]
);

$loader->register();

$di = new FactoryDefault();

$di->set(
    'db',
    function() {
        return new PdoMysql([
            'host'      => 'localhost',
            'username'  => 'username',
            'password'  => 'password',
            'dbname'    => 'flats',
        ]);
    }
);

$app = new Micro($di);

$app->get(
    '/',
    function() {
        echo "Success";
    }
);

$app->get(
    '/api/flats',
    function() use ($app) {
        $phql = 'SELECT * FROM App\Models\Flats ORDER BY dateAdded';

        $flats = $app->modelsManager->executeQuery($phql);

        echo json_encode($flats);
    }
);

$app->handle();
