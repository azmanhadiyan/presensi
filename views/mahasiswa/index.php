<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Kelas;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MahasiswaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mahasiswa';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mahasiswa-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Mahasiswa', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id_mahasiswa',
            'nim',
            'nama',
            [
                'attribute'=>'id_kelas',
                'value'=>function($data){
                    return $data->getNamaKelas();
                }
            ],
            // 'id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
