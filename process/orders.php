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


            //resgatando acompanhamentos 

            $acompanhamentosQuery = $conn->prepare("SELECT * FROM  hamburguer_acompanhamento WHERE hamburguer_id = :hamburguer_id");

            $acompanhamentosQuery->bindParam(":hamburguer_id", $hamburguer["id"]);

            $acompanhamentosQuery->execute();

            $acompanhamentos = $paoQuery->fetchAll(PDO::FETCH_ASSOC);


            //resgatando nome dos acompanhamentos
            $acompanhamentosHamburguer = [];

            $acompanhamentoQuery = $conn->prepare("SELECT * FROM acompanhamentos WHERE id = :acompanhamento_id");

            foreach($acompanhamentos as $acompanhamento) {

                $acompanhamentoQuery->bindParam(":acompanhamento_id", $acompanhamento["acompanhamento_id"]);

                $acompanhamentoQuery->execute();

                $acompanhamentoHamburguer = $acompanhamentoQuery->fetch(PDO::FETCH_ASSOC);

                array_push($acompanhamentosHamburguer, $acompanhamentoHamburguer["nome"]);

            };

            $hamburguer["acompanhamentos"] = $acompanhamentosHamburguer;


            //adicionar status do pedido 
            $hamburguer["status"] = $pedido["status_id"];

            array_push($hamburguers, $hamburguer);

            
        };

        //Resgatando status
        $statusQuery = $conn->query("SELECT * FROM status;");
        $status = $statusQuery->fetchAll();


    } else if ($method === "POST"){

        $type = $_POST["type"];

        //deletar pedido 
        if($type === "delete"){

            $hamburguerId = $_POST["id"];

            $deleteQuery = $conn->prepare("DELETE FROM pedidos WHERE hamburguer_id = :hamburguer_id;");
            $deleteQuery->bindParam(":hamburguer_id", $hamburguerId, PDO::PARAM_INT);

            $deleteQuery->execute();

            $_SESSION["msg"] = "Pedido removido com sucesso!";
            $_SESSION["status"] = "success";


        //atualizar status do pedido
        } else if($type === "update"){

            $hamburguerId = $_POST["id"];
            $statusId = $_POST["status"];

            $updateQuery = $conn->prepare("UPDATE pedidos SET status_id = :status_id WHERE hamburguer_id = :hamburguer_id");

            $updateQuery->bindParam(":hamburguer_id", $hamburguerId, PDO::PARAM_INT);
            $updateQuery->bindParam(":status_id", $statusId, PDO::PARAM_INT);

            $updateQuery->execute();

            $_SESSION["msg"] = "Pedido atualizado com sucesso!";
            $_SESSION["status"] = "success";


        };

        //retorna para dash 
        header("Location: ../dashboard.php");

    }

?>