<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;



// Pour voir tous le contenue de la table marques

// /api/marques/all

$app->get('/api/marques/all', function (Request $request, Response $response) {
 
    $sql = "SELECT * FROM marques";

    try {
        $db = new DB();
        $conn = $db->connect();

        $stmt = $conn->query($sql);
        $marques = $stmt->fetchAll(PDO::FETCH_OBJ);

        $db = null;
        $response->getBody()->write(json_encode($marques));
        return $response
            ->withHeader('content-type','application/json')
            ->withStatus(200);
    } catch (PDOException $ex) {
        $err = array(
            "message" => $ex->getMessage()
        );

        
        $response->getBody()->write(json_encode($err));
        return $response
            ->withHeader('content-type','application/json')
            ->withStatus(500);
    }


});


// Pour ajouter une line de donner

// /api/marques/add

$app->post('/api/marques/add', function (Request $request, Response $response, array $args) {
    $marque = $request->getParam('marque');
    $logo = $request->getParam('logo');
 
    $sql = "INSERT INTO marques (idxMarque, marque, logo) VALUE (NULL, :marque, :logo)";
   
     //$sql = "INSERT INTO `marques` (`idxMarques`, `marques`, `logo`) VALUE (NULL, :marques, :logo)";


    try {
        $db = new DB();
        $conn = $db->connect();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':marque', $marque);
        $stmt->bindParam(':logo', $logo);

        $result = $stmt->execute();

        $db = null;
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('content-type','application/json')
            ->withStatus(200);
    } catch (PDOException $ex) {
        $err = array(
            "message" => $ex->getMessage()
        );

        
        $response->getBody()->write(json_encode($err));
        return $response
            ->withHeader('content-type','application/json')
            ->withStatus(500);
    }

});


// Pour modifier la line de donner dont l'id est égale à 1

// /api/marques/update/1

$app->put('/api/marques/update/{id}', function (Request $request, Response $response, array $args) {

    $id = $request->getAttribute('id');
    $marque = $request->getParam('marque');
    $logo = $request->getParam('logo');

    $sql = "UPDATE marques SET 
                marque = :marque, 
                logo = :logo 
            WHERE idxMarque = $id";

    try {
        $db = new DB();
        $conn = $db->connect();
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':marque', $marque);
        $stmt->bindParam(':logo', $logo);
    
        $stmt->execute();

        $db = null;
        return $response
            ->withHeader('content-type','application/json')
            ->withStatus(200);
    } catch (PDOException $ex) {
        $err = array(
            "message" => $ex->getMessage()
        );

        
        $response->getBody()->write(json_encode($err));
        return $response
            ->withHeader('content-type','application/json')
            ->withStatus(500);
    }

});


// Pour supprimer la line de donner dont l'id est égale à 1

// /api/marques/delete/1

$app->delete('/api/marques/delete/{id}', function (Request $request, Response $response, array $args) {

    $id = $request->getAttribute('id');

    $sql = "DELETE FROM marques WHERE idxMarque = $id";

    try {
        $db = new DB();
        $conn = $db->connect();
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':marque', $marque);
        $stmt->bindParam(':logo', $logo);
    
        $stmt->execute();

        $db = null;
        return $response
            ->withHeader('content-type','application/json')
            ->withStatus(200);
    } catch (PDOException $ex) {
        $err = array(
            "message" => $ex->getMessage()
        );

        
        $response->getBody()->write(json_encode($err));
        return $response
            ->withHeader('content-type','application/json')
            ->withStatus(500);
    }

});


// Pour afficher l'élément dont l'id est égale à 1

// /api/marques/1

$app->get('/api/marques/{id}', function (Request $request, Response $response, array $args) {

    $id = $args['id'];
 
    $sql = "SELECT * FROM marques WHERE idxMarque = $id";

    try {
        $db = new DB();
        $conn = $db->connect();

        $stmt = $conn->query($sql);
        $marque = $stmt->fetch(PDO::FETCH_OBJ);

        $db = null;
        $response->getBody()->write(json_encode($marque));
        return $response
            ->withHeader('content-type','application/json')
            ->withStatus(200);
    } catch (PDOException $ex) {
        $err = array(
            "message" => $ex->getMessage()
        );

        
        $response->getBody()->write(json_encode($err));
        return $response
            ->withHeader('content-type','application/json')
            ->withStatus(500);
    }

});

?>
