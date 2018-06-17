<?php

use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */

$this->title = 'My Yii Application';
$imageNotDisponible = "http://tinyurl.com/y7zpgrk2";

?>
<style type="text/css">
img, .card {
    margin: 0 auto;
}    
a {
    float: right;
}
</style>
<div class="container">

    <div class="row">
        <div class="col-lg-12">
            <h1>Categoria: <?= Html::encode($products["name"]) ." - ". Html::encode($products["id"]) ?></h1>
            <?= Html::img($products["picture"], ['class' => 'img-responsive rounded']); ?>
        </div>
    </div>

        <div class="row">
        <?php
            foreach($childrenProducts as $item)
            {
                $picture = (!empty($item["picture"])) ? $item["picture"] : $imageNotDisponible;

        ?>                
            <div class="col-lg-6">

                <div class="card" style="width: 18rem;">
                  <img class="card-img-top" src=<?= $picture ?> alt="Card image cap" style='width: 200px;'>
                  <div class="card-body">
                    <h5 class="card-title"><?= $item["name"]; ?></h5>
                    <button class="btn btn-primary add">Agregar</button>
                  </div>
                </div>

            </div>



        <?php                
            }
        ?>
            
        </div>
</div>

<?php

echo Html::a('Click me', ['site/addproduct'], [
        'id' => 'ajax_link_01',
        'data-on-done' => 'simpleDone',
    ]
);
echo Html::tag('div', '...', ['id' => 'ajax_result_01']);
 
// $this->registerJs("$('#ajax_link_01').click(handleAjaxLink);", \yii\web\View::POS_READY);




$this->registerJsFile(
    '@web/js/main.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);





$url = Url::toRoute('/site/product');

$script = <<< JS
    $(".add").click(function(){ 
        $.post('<?= $url ?>', function(result) {
            $("#div1").html(result);
            alert("sss")
        });
    });
JS;
$this->registerJs($script);
?>