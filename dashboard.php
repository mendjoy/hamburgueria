<?php
    include_once("templates/header.php");
    include_once("process/orders.php");
?>

    <div id="main-container-dash">
        <div class="container">
            <div>
                <h2>Gerenciar Pedidos</h2>
            </div>

            <div class="table-container">

                <table class="table">
                    <thead>
                        <tr>
                            <th><span>Pedido</span></th>
                            <th><span>Pão</span></th>
                            <th><span>Burguer</span></th>
                            <th><span>Acompanhamentos</span></th>
                            <th><span>Status</span></th>
                            <th><span>Ações</span></th>
                        </tr>
                    </thead>

                    <tbody>
                       <?php foreach($hamburguers as $hamburguer) : ?>

                        <tr>
                            <td><?=$hamburguer["id"]?></td>
                            <td><?=$hamburguer["pao"]?></td>
                            <td><?=$hamburguer["burguer"]?></td>
                            <td> 
                                <ul>
                                    <?php foreach($hamburguer["acompanhamentos"] as $acompanhamento) : ?>
                                        <li><?= $acompanhamento ;?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </td>

                            <td>
                                <form action="process/orders.php" method="POST" class="update-form">
                                    <input type="hidden" name="type" value="<?=$hamburguer["id"]?>">
                                    <input type="hidden" name="id" value="1">

                                    <select name="status">
                                        <?php foreach($status as $s): ?>
                                            <option value="<?=$s["id"]?>" <?php echo($s["id"] == $hamburguer["status"]) ? "selected" : ""; ?>><?=$s["tipo"]?></option>
                                        <?php endforeach ?>

                                    </select>

                                    <button type="submit" class="update-btn">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </form>
                            </td>
                            <td>
                                <form action="process/orders.php" method="POST">
                                    <input type="hidden" name="type" value="delete">
                                    <input type="hidden" name="id" value="<?=$hamburguer["id"]?>">

                                    <button type="submit" class="delete-btn">
                                        <i class="fas fa-times"></i>

                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>

                </table>

            </div>
        </div>
    </div>



<?php
    include_once("templates/footer.php")
?>
