<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

use Phalcon\Http\Response;
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
            'username'  => 'user',
            'password'  => 'password',
            'dbname'    => 'flats',
        ]);
    }
);

$app = new Micro($di);

$app->get(
    '/',
    function() {
        echo "https://github.com/nathanhollows/flatsAPI";
    }
);

$app->get(
    '/api/flats',
    function() use ($app) {
        $phql = 'SELECT * FROM App\Models\Flats 
            WHERE dateRemoved IS NULL
            ORDER BY dateAdded';

        $flats = $app->modelsManager->executeQuery($phql)->getFirst();

        echo json_encode($flats);
    }
);

$app->get(
    '/api/flats/id/{id}',
    function($id) use ($app) {
        $phql = 'SELECT * FROM App\Models\Flats 
            WHERE id = :id:';

        $flats = $app->modelsManager->executeQuery(
            $phql,
            ['id' => $id]
        );

        echo json_encode($flats);
    }
);

$app->delete(
    '/api/flats/id/{id}',
    function($id) use ($app) {
        $phql = 'UPDATE App\Models\Flats
            SET dateRemoved = CURRENT_TIMESTAMP
            WHERE id = :id:';

        $status = $app->modelsManager->executeQuery(
            $phql,
            ['id' => $id]
        );

        $response = new Response();

        if ($status->success() === true) {
            $response->setJsonContent([
                'status'    => "OK",
            ]);
        } else {
            $response->setStatusCode(409, 'Conflict');

            $errors = [];

            foreach ($status->getMessages() as $message) {
                $errors[] = $message->getMessage();
            }

            $response->setJsonContent([
                'status'    => 'ERROR',
                'messages'  => $errors,
            ]);
        }

        return $response;
    }
);

$app->handle();
