<?php

/**
 * Cadastra um novo <Livro></Livro>
 * @request curl -X POST http://localhost:8000/book -H "Content-type: application/json" -d '{"name":"O Oceano no Fim do Caminho", "author":"Neil Gaiman"}'
 */
$app->post('/book', function (Request $request, Response $response) use ($app) {

    $params = (object) $request->getParams();

    /**
     * Pega o Entity Manager do nosso Container
     */
    $entityManager = $this->get('em');

    /**
     * Instância da nossa Entidade preenchida com nossos parametros do post
     */
    $book = (new Book())->setName($params->name)
        ->setAuthor($params->author);
    
    /**
     * Persiste a entidade no banco de dados
     */
    $entityManager->persist($book);
    $entityManager->flush();


    $return = $response->withJson($book, 201)
        ->withHeader('Content-type', 'application/json');
    return $return;
});