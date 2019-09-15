<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Kelas;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KelasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kelas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kelas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Kelas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id_kelas',
            
            [
                'attribute'=>'id_jurusan',
                'value'=>function($data){
                    return $data->getIdJurusan();
                }
            ],
            'angkatan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
