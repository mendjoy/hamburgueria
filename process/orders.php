<?php

    include_once("conn.php");

    $method = $_SERVER["REQUEST_METHOD"];

    if($method === "GET") {

        $pedidosQuery = $conn->query("SELECT * FROM pedidos;");

        $pedidos = $pedidosQuery->fetchAll();

        $hamburguers = [];

        foreach($pedidos as $pedido){

            $hamburguer = [];

            //Resgatando hamburguer
            $hamburguer["id"] = $pedido["hamburguer_id"];

            $hamburguerQuery = $conn->prepare("SELECT * FROM  hamburguers WHERE id = :hamburguer_id");

            $hamburguerQuery->bindParam(":hamburguer_id", $hamburguer["id"]);

            $hamburguerQuery->execute();

            $hamburguerData = $hamburguerQuery->fetch(PDO::FETCH_ASSOC);


            //Resgatando o tipo de pão
            $paoQuery = $conn->prepare("SELECT * FROM  pao WHERE id = :pao_id");

            $paoQuery->bindParam(":pao_id", $hamburguerData["pao_id"]);

            $paoQuery->execute();

            $pao = $paoQuery->fetch(PDO::FETCH_ASSOC);

            $hamburguer["pao"] = $pao["tipo"];




        };

    } else if ($method === "POST"){

    }

?>