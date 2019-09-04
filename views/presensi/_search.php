<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PresensiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="presensi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_presensi') ?>

    <?= $form->field($model, 'id_mahasiswa') ?>

    <?= $form->field($model, 'id_dosen') ?>

    <?= $form->field($model, 'id_matakuliah') ?>

    <?= $form->field($model, 'Tgl_presensi') ?>

    <?php // echo $form->field($model, 'hasil_presensi') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
