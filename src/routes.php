<?php
// Routes
$app->get('/', function ($request, $response, $args){
    $lista = new Lista($this->db);

    $args['lista'] = $lista->getLista();

    return $this->renderer->render($response, 'home.phtml', $args);
});

$app->get('/add', function($request, $response, $args){
    return $this->renderer->render($response, 'add.phtml', $args);
});
$app->post('/add', function($request, $response, $args){
    $lista = new Lista($this->db);
    $data = $request->getParsedBody();
    $lista->inserir($data);
    return $response->withStatus(302)->withHeader("Location", "/");
});

$app->get('/edit/{id}', function($request, $response, $args){
    $lista = new Lista($this->db);
    $args['info'] = $lista->getContato($args['id']);
    return $this->renderer->render($response, 'edit.phtml', $args);
});

$app->post('/edit/{id}', function($request, $response, $args){
    $data = $request->getParsedBody();
    $lista = new Lista($this->db);
    $lista->update($data, $args['id']);
    return $response->withStatus(302)->withHeader("Location", "/");
});

$app->get('/del/{id}', function($request, $response, $args){
    $lista = new Lista($this->db);
    $lista->del($args['id']);
    return $response->withStatus(302)->withHeader("Location", "/");
});
/*
$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->get('/hello/{name}', function ($request,$response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});
*/