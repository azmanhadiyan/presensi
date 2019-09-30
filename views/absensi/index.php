<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AbsensiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Presensi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="absensi-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Presensi', ['create'], ['class' => 'btn btn-success']) ?>
        <!-- <?= Html::a('Export to Excel', ['absensi/export-excel'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Export to PDF', ['absensi/export-mpdf'], ['class' => 'btn btn-success']) ?> -->
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id_presensi',
            
            [
                'attribute'=>'id_jadwal',
                'value'=>function($data){
                    return $data->getNamaJadwal();
                }
            ],
            [
                'attribute'=>'id_mahasiswa',
                'value'=>function($data){
                    return $data->getIdMahasiswa();
                }
            ],
            'tanggal',
            'foto',
            //'kehadiran',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
