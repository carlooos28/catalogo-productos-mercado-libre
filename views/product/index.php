<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Ecommerce Online 123';
$imageNotDisponible = "http://tinyurl.com/y7zpgrk2";

$this->registerCssFile("@web/css/main.css", [
    'depends' => [\yii\bootstrap\BootstrapAsset::className()],
], 'css-print-theme');

?>

<div class="container">

    <div class="row">
        <div class="col-lg-12">
            <h2>Categoria: <?= Html::encode($category["name"]) ." - ". Html::encode($category["id"]) ?></h2>
            <?= Html::img($category["picture"], ['class' => 'img-responsive rounded']); ?>
        </div>
    </div>

    <div class="row">
	    <?php
	        foreach($products as $item)
	        {
	            $picture = (!empty($item["picture"])) ? $item["picture"] : $imageNotDisponible;

	    ?>                
        <div class="col-lg-6">

            <div class="card">
              <img class="card-img-top" src=<?= $picture ?> alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title"><?= $item["name"]; ?></h5>
                <button 
                	class="btn btn-primary addProduct pull-right",
                	data-product-picture = <?= $picture ?>
                >
                	Agregar
                </button>
              </div>
            </div>

        </div>

	    <?php                
	        }
	    ?>
        
    </div>
</div>

<?php
	$this->registerJsFile(
	    '@web/js/main.js',
	    ['depends' => [\yii\web\JqueryAsset::className()]]
	);
?>