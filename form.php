<?php
    include_once("templates/header.php");
    include_once("process/hamburgueria.php");
?>

<div class="alert-success">
        <p>Pedido feito com sucesso!</p>
</div>

<div id="form-container">
    
    <h2>Faça o seu Pedido</h2>
    
    <form action="process/burguer.php" id="burguer-form" method="POST">

        <div>
            <label for="pao">Pão:</label>
                <select name="pao" id="pao">
                    <option value="">Selecione</option>

                    <?php foreach($paes as $pao) : ?>
                        <option value="<?=$pao["id"]?>"> <?= $pao["tipo"]?> </option>
                    <?php endforeach ?>

                </select>
        </div>

        <div>
            <label for="burguer">Hamburguer:</label>
                <select name="burguer" id="burguer">
                    <option value="">Selecione</option>

                    <?php foreach($burguers as $burguer) : ?>
                        <option value="<?=$burguer["id"]?>"> <?= $burguer["tipo"]?> </option>
                    <?php endforeach ?>

                </select>
        </div>

        <div>
            <label for="acompanhamentos">Acompanhamentos: (Máximo 4)</label>
                <select multiple name="acompanhamentos[]" id="acompanhamentos">

                <?php foreach($acompanhamentos as $acompanhamento) : ?>
                        <option value="<?=$acompanhamento["id"]?>"> <?= $acompanhamento["nome"]?> </option>
                    <?php endforeach ?>
                    
                </select>
        </div>

        <div>
            <input type="submit" class="btn" value="Enviar Pedido">
        </div>

    </form>
</div>


<?php
    include_once("templates/footer.php")
?>
