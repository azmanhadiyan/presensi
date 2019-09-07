<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AbsensiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="absensi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_presensi') ?>

    <?= $form->field($model, 'id_jadwal') ?>

    <?= $form->field($model, 'id_mahasiswa') ?>

    <?= $form->field($model, 'tanggal') ?>

    <?= $form->field($model, 'foto') ?>

    <?php // echo $form->field($model, 'kehadiran') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
