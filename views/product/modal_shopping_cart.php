<?php

use yii\helpers\Html;

?>

<!-- Modal -->
<div id="modalCart" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Carrito de Compras :)</h4>
        </div>
        <div class="modal-body">
            <table class="table table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>ID Mercado Libre</th>
                  <th>Nombre</th>
                  <th>Estado</th>
                  <th>Imágen</th>  
                  <th>-</th>  
                </tr>
                </thead>
                <tbody>
                <?php
                    foreach($listCart as $item)
                    {
                        $picture = (!empty($item["picture"])) ? $item["picture"] : $imageNotDisponible;
                ?>                
                <tr>
                    <td><?= $item["_id"]; ?></td>
                    <td><?= $item["mercadolibre_id"]; ?></td>
                    <td><?= $item["name"]; ?></td>  
                    <td><?= $item["status"]; ?></td>
                    <td> <?= Html::img($picture, ['class' => 'img-responsive rounded']); ?></td>
                    <td>
                    <?php
                        echo Html::a('Eliminar', ['product/delete'], [
                                'class' => 'btn btn-danger deleteProduct',
                                'data-id' => $item["_id"],
                            ]
                        );
                    ?>          
                    </td>
                </tr>
                <?php                
                    }
                ?>
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Volver al Catálogo</button>
        </div>
    </div>

    </div>
</div>