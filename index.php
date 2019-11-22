<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

use Phalcon\Db\Adapter\Pdo\Mysql as PdoMysql;
use Phalcon\Di\FactoryDefault;
use Phalcon\Http\Response;
use Phalcon\Loader;
use Phalcon\Mvc\Micro;
use Phalcon\Security\Random;

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
        $limit = $app->request->get("limit", "int", 10000);
        $offset = $app->request->get("offset", "int", 0);
        $phql = "SELECT id, price, bedrooms, bathrooms, parking,
                    heroText, description, agent, image, url, type,
                    dateAdded, dateAvailable, pets, address
            FROM App\Models\Flats 
            WHERE dateRemoved IS NULL
            ORDER BY dateAdded
            LIMIT $limit
            OFFSET $offset";

        $flats = $app->modelsManager->executeQuery($phql);

        $response = new Response();
        $response->setJsonContent([
            'status' => 'OK',
            'data'  => $flats,
        ]);
        return $response;
    }
);

$app->post(
    '/api/flats',
    function() use ($app) {
        $request = $app->request;

        $phql = 'INSERT INTO App\Models\Flats
            (id, price, bedrooms, bathrooms, parking, heroText, 
            description, agent, image, type, dateAvailable, 
            pets, address, url) VALUES
            (:id:, :price:, :bedrooms:, :bathrooms:, :parking:, :heroText:, 
            :description:, :agent:, :image:, :type:, :dateAvailable:, 
            :pets:, :address:, :url:)';

        $random = new Random();
        $uuid = $random->uuid();

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                'id'=> $uuid,
                'address' => $request->getPost("address", "string", null),
                'price' => $request->getPost("price", "absint", null),
                'bedrooms' => $request->getPost("bedrooms", "absint", null),
                'bathrooms' => $request->getPost("bathrooms", "absint", null),
                'parking' => $request->getPost("parking", "absint", null),
                'heroText' => $request->getPost("heroText", "string", null),
                'description' => $request->getPost("description", "string", null),
                'agent' => $request->getPost("agent", "string", null),
                'image' => $request->getPost("image", "string", null),
                'url' => $request->getPost("url", "string", null),
                'type' => $request->getPost("type", "string", null),
                'dateAvailable' => $request->getPost("dateAvailble", null, date("Y-m-d")),
                'pets' => $request->getPost("pets", "absint", null),
            ]
        );

        $response = new Response();

        if ($status->success()) {
            $response->setStatusCode(201, 'Created');
            $response->setJsonContent([
                'status'    => 'OK',
                'data'      => $uuid,
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
            SET dateRemoved = CURRENT_TIMESTAMP()
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
