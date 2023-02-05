<?php

 include_once("conn.php");

 $method = $_SERVER["REQUEST_METHOD"];

 if($method === "GET"){

    $paesQuery = $conn->query("SELECT * FROM pao;");
    $paes = $paesQuery->fetchAll();

    $burguersQuery = $conn->query("SELECT * FROM burguer;");
    $burguers = $burguersQuery->fetchAll();

    $acompanhamentosQuery = $conn->query("SELECT * FROM acompanhamentos");
    $acompanhamentos = $acompanhamentosQuery->fetchAll();




 } else if($method === "POST"){

    $data = $_POST;

    $pao = $data["pao"];
    $burguer = $data["burguer"];
    $acompanhamento = $data["acompanhamento"];

    if(count($acompanhamentos) > 4 ){

        $_SESSION["msg"] = "Selecione no máximo 4 acompanhamentos";
        $_SESSION["status"] = "warning";

    } else {

        //salvando dados 
        $stmt = $conn->prepare("INSERT INTO hamburguers (burguer_id, pao_id) VALUES (:burguer, :pao);");

        //filtrando inputs 
        $stmt = bindParam(":burguer", $burguer, PDO::PARAM_INT);
        $stmt = bindParam(":pao", $pao, PDO::PARAM_INT);

        //executar a query 
        $stmt->execute();

        $hamburguerId = $conn->lasInsertId();

        $stmt = $conn->prepare("INSERT INTO hamburguer_acompanhamentos (hamburguers_id, acompanhamentos_id VALUES (:, :acompanhamentos)");
    }

 }

 //retorna para pagina inicial 
 
   
?>