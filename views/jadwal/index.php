<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\JadwalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jadwal';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jadwal-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Jadwal', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id_jadwal',
            'jam',
            [
                'attribute'=>'id_matakuliah',
                'value'=>function($data){
                    return $data->getIdMatkul();
                }
            ],
            [
                'attribute'=>'id_kelas',
                'value'=>function($data){
                    return $data->getIdKelas();
                }
            ],
            [
                'attribute'=>'id_ruangan',
                'value'=>function($data){
                    return $data->getIdRuangan();
                }
            ],
            //'status',
            //'id_dosen',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
