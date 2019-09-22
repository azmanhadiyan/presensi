<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Absensi */

$this->title = $model->id_presensi;
$this->params['breadcrumbs'][] = ['label' => 'Absensis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="absensi-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_presensi], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_presensi], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
        ],
    ]) ?>

</div>
