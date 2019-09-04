<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PresensiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Presensis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="presensi-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Presensi', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_presensi',
            'id_mahasiswa',
            'id_dosen',
            'id_matakuliah',
            'Tgl_presensi',
            //'hasil_presensi',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
