<?php

 include_once("conn.php");

 $method = $_SERVER["REQUEST_METHOD"];

 if($method === "GET"){

    $paesQuery = $conn->query("SELECT * FROM paes;");
    $paes = $paesQuery->fetchAll();

    $burguersQuery = $conn->query("SELECT * FROM burguers;");
    $burguers = $burguersQuery->fetchAll();

    $acompanhamentosQuery = $conn->query("SELECT * FROM acompanhamentos");
    $acompanhamentos = $acompanhamentosQuery->fetchAll();

 } else if($method === "POST") {

  $data = $_POST;
  $pao = $data["pao"];
  $burguer = $data["burguer"];
  $acompanhamentos = $data["acompanhamentos"];

  //validar quantos acompanhamentos 
  if(count($acompanhamentos) > 4 ){

    $_SESSION["msg"] = "Selecione no máximo 4 acompanhamentos";
    $_SESSION["status"] = "warning";

  } else{

    //salvando burguer e pao
    $stmt = $conn->prepare("INSERT INTO hamburguers (pao_id, burguer_id) VALUES (:pao, :burguer)");

    //filtrando input
    $stmt->bindParam(":pao", $pao, PDO::PARAM_INT);
    $stmt->bindParam(":burguer", $burguer, PDO::PARAM_INT);

    $stmt->execute();

    //resgatando ultimo id do ultimo hamburguer
    $hamburguerId = $conn->lastInsertId();

    $stmt = $conn->prepare("INSERT INTO hamburguer_acompanhamento (hamburguer_id, acompanhamento_id) VALUES (:hamburguer, :acompanhamento)");

    //salvando todos os acompanhamentos 
    foreach ($acompanhamentos as $acompanhamento) {

      //filtrar input 
      $stmt->bindParam(":hamburguer", $hamburguerId, PDO::PARAM_INT);
      $stmt->bindParam(":acompanhamento", $acompanhamento, PDO::PARAM_INT);

      $stmt->execute();
 
    }

      $statusId = 1;

    //criar pedido da pizza
    $stmt = $conn->prepare("INSERT INTO pedidos(hamburguer_id, status_id) VALUES (:hamburguer, :status)");

    //filtrar input
    $stmt->bindParam(":hamburguer", $hamburguerId);
    $stmt->bindParam(":status", $statusId);
    

    $stmt->execute();

  }


  //retorna para página inicial
  header("Location: ..");


 }
?>