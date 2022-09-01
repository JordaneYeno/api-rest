<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


$app->get('/api/chaussures/all', function (Request $request, Response $response) {
 
    $sql = "SELECT * FROM chaussures";

    try {
        $db = new DB();
        $conn = $db->connect();

        $stmt = $conn->query($sql);
        $chaussures = $stmt->fetchAll(PDO::FETCH_OBJ);

        $db = null;
        $response->getBody()->write(json_encode($chaussures));
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


$app->post('/api/chaussures/add', function (Request $request, Response $response, array $args) {
    $idMarque = $request->getParam('idxMarque');
    $taille = $request->getParam('taille');
    $couleur = $request->getParam('couleur');
    $prix = $request->getParam('prix');
    $nomChaussure = $request->getParam('nomChaussure');
 
    $sql = "INSERT INTO chaussures (idxChaussure, idxMarque, taille, couleur, prix, nomChaussure) VALUE (NULL, :idxMarque, :taille, :couleur, :prix, :nomChaussure)";
        
    try {
        $db = new DB();
        $conn = $db->connect();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idxMarque', $idMarque);
        $stmt->bindParam(':taille', $taille);
        $stmt->bindParam(':couleur', $couleur);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':nomChaussure', $nomChaussure);

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


$app->put('/api/chaussures/update/{id}', function (Request $request, Response $response, array $args) {

    $id = $request->getAttribute('id');
    $idxMarque = $request->getParam('idxMarque');
    $taille = $request->getParam('taille');
    $couleur = $request->getParam('couleur');
    $prix = $request->getParam('prix');
    $nomChaussure = $request->getParam('nomChaussure');

    $sql = "UPDATE chaussures SET  
                idxMarque = :idxMarque, 
                taille = :taille, 
                couleur = :couleur, 
                prix = :prix, 
                nomChaussure = :nomChaussure 
            WHERE idxChaussure = $id";

    try {
        $db = new DB();
        $conn = $db->connect();
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idxMarque', $idxMarque);
        $stmt->bindParam(':taille', $taille);
        $stmt->bindParam(':couleur', $couleur);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':nomChaussure', $nomChaussure);
    
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


$app->delete('/api/chaussures/delete/{id}', function (Request $request, Response $response, array $args) {

    $id = $request->getAttribute('id');

    $sql = "DELETE FROM chaussures WHERE idxChaussure = $id";

    try {
        $db = new DB();
        $conn = $db->connect();
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':chaussure', $chaussure);
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


$app->get('/api/chaussures/{id}', function (Request $request, Response $response, array $args) {

    $id = $args['id'];
 
    $sql = "SELECT * FROM chaussures WHERE idxChaussure = $id";

    try {
        $db = new DB();
        $conn = $db->connect();

        $stmt = $conn->query($sql);
        $chaussure = $stmt->fetch(PDO::FETCH_OBJ);

        $db = null;
        $response->getBody()->write(json_encode($chaussure));
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
